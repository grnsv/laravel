<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Contracts\Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Parser $service)
    {
        $urls = [
            'https://news.yandex.ru/computers.rss',
            'https://habr.com/ru/rss/best/monthly/',
            'https://habr.com/ru/rss/hub/webdev/top50/',
            'https://www.opennet.ru/opennews/opennews_6_pda.rss',
            'https://www.cbr-xml-daily.ru/daily_utf8.xml',
        ];

        $url = \Illuminate\Support\Arr::random($urls);

        $xml = $service->setLink($url)->parse();

        if (array_key_exists('news', $xml)) {
            $data = $xml['news'];

            foreach ($data as &$news) {
                $news['slug'] = \Illuminate\Support\Str::slug($news['title']);
                $news['status'] = 'active';
                $news['created_at'] = date('Y-m-d H:i:s', strtotime($news['pubDate']));
                unset($news['pubDate']);
            }

            DB::table('news')->insert($data);
            dump('Новости добавлены в базу', $xml);
        } else {
            dump('Ресурс не является источником новостей', $xml);
        }
    }
}
