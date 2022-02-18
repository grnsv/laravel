<?php

declare(strict_types=1);

namespace App\Services;

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

    public function parse(): array
    {
        if ($this->document->getContent()->getName() == 'rss') {
            return $this->document->parse([
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
                    // 'uses' => 'channel.item[title,link,guid,description,pubDate,category(@=@)]',
                    'uses' => 'channel.item[title,link,guid,description,pubDate]',
                ],
            ]);
        } else {
            return json_decode(
                json_encode($this->document->getContent()),
                true
            );
        }
    }
}
