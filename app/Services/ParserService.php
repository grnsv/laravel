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
    private Document $document;

    public function setLink(string $link): Parser
    {
        $this->document = XmlParser::load($link);
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

        $source = Source::where('title', '=', $xml['title'])->first();
        if ($source === null) {
            $source = Source::create([
                'title' => $xml['title'],
                'link' => $xml['link'],
                'description' => $xml['description'],
                'image' => $xml['image'],
            ]);
        }

        $newsList = $xml['news'];

        foreach ($newsList as &$news) {
            $news['status'] = 'active';
            $news['created_at'] = date('Y-m-d H:i:s', strtotime($news['pubDate']));
            unset($news['pubDate']);
            $news['isImage'] = !!($news['image']);
            $news['source_id'] = $source->id;
            $categories = array_map(
                fn ($category) => Category::firstOrCreate(['title' => $category])->id,
                $news['category'] ??= ['Uncategorized']
            );
            unset($news['category']);
            $created = News::firstOrCreate($news);
            if ($created) {
                $created->categories()->attach($categories);
            } else {
                throw new Exception("Не удалось добавить новость");
            }
        }
    }
}
