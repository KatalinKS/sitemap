<?php

namespace KatalinKS\Sitemap\Serializers;

class ArrayToCSV extends Serializer
{
    protected array $headers = [
        'loc',
        'lastmod',
        'priority',
        'changefreq'
    ];

    protected function serialize(array $pages): string
    {
        $header = $this->generateHeader();
        $body = $this->generateBody($pages);

        return $header . $body;
    }

    protected function generateHeader(): string
    {
        return implode(";", $this->headers) . ';' . PHP_EOL;
    }

    protected function generateRow(array $page): string
    {
        //Это нужно что бы сохранить порядок стодлбцов как тз, не думаю, что это важно но все же.
        $tmpArray = [];

        foreach ($this->headers as $header) {
            $tmpArray[$header] = $page[$header];
        }

        return implode(";", $tmpArray) . ';';
    }

    protected function generateBody(array $pages): string
    {
        return collect($pages)->map(function ($page) {
            return $this->generateRow($page);
        })->implode(PHP_EOL);
    }


}
