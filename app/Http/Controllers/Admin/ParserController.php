<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Jobs\NewsParsingJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $urls = [
            'https://news.yandex.ru/computers.rss',
            'https://habr.com/ru/rss/best/monthly/',
            'https://habr.com/ru/rss/hub/webdev/top50/',
            'https://habr.com/ru/rss/hub/php/top50/',
            'https://habr.com/ru/rss/hub/javascript/top50/',
            'https://habr.com/ru/rss/hub/reactjs/top50/',
            'https://www.opennet.ru/opennews/opennews_6_pda.rss',
            'https://gb.ru/posts.atom',
            'https://elementy.ru/rss/news',
            'https://antropogenez.ru/rss/',
            'https://www.cbr-xml-daily.ru/daily_utf8.xml',
        ];

        foreach ($urls as $url) {
            dispatch(new NewsParsingJob($url));
            echo "Parsing URL: " . $url . "<br>";
        }

        echo "Parsing completed";
    }
}
