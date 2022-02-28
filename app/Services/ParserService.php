<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use App\Models\News;
use App\Models\Source;
use App\Models\Category;
use App\Contracts\Parser;
use Laravie\Parser\Document;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserService implements Parser
{
    private string $url;
    private Document $document;

    public function setLink(string $link): Parser
    {
        $this->url = $link;
        $this->document = XmlParser::load($link);
        $file = file_get_contents($link);
        $xml = simplexml_load_string($file);
        $this->document->setContent($xml);
        return $this;
    }

    public function parse(): void
    {
        $xml = [];
        if ($this->document->getContent()->getName() == 'rss') {
            $xml = $this->document->parse([
                'title' => [
                    'uses' => 'channel.title',
                ],
                'link' => [
                    'uses' => 'channel.link',
                ],
                'description' => [
                    'uses' => 'channel.description',
                ],
                'image' => [
                    'uses' => 'channel.image.url',
                ],
                'news' => [
                    'uses' => 'channel.item[title,link,guid,description,pubDate,image.url>image,category(@=@)]',
                ],
            ]);
        } else {
            throw new Exception("Ресурс не является источником новостей формата RSS");
        }

        $source = Source::where('url', '=', $this->url)->first();
        if ($source === null) {
            $source = Source::create([
                'url'         => $this->url,
                'title'       => $xml['title'],
                'link'        => $xml['link'],
                'description' => $xml['description'],
                'image'       => $xml['image'],
            ]);
        }

        $newsList = $xml['news'];

        foreach ($newsList as &$news) {
            $news['status'] = 'active';
            $news['created_at'] = date('Y-m-d H:i:s', strtotime($news['pubDate']));
            unset($news['pubDate']);
            if (!$news['image']) {
                $dom = new \DOMDocument;
                $dom->loadHTML($news['description']);
                $img = $dom->getElementsByTagName('img')->item(0);
                if ($img) {
                    $news['image'] = $img->attributes->getNamedItem("src")->value;
                }
            }
            $news['source_id'] = $source->id;
            $categories = array_map(
                fn ($category) => Category::firstOrCreate(['title' => $category])->id,
                $news['category'] ??= ['Uncategorized']
            );
            unset($news['category']);
            $created = News::firstOrCreate($news);
            if ($created) {
                $created->categories()->sync($categories);
            } else {
                throw new Exception("Не удалось добавить новость");
            }
        }
    }
}
