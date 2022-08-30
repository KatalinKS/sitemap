<?php

namespace KatalinKS\Sitemap\Collector;

use KatalinKS\Sitemap\Contracts\SitemapDataContract;

class SitemapCollector implements SitemapDataContract
{

    public function get(): array
    {
        return [
            [
                "loc" => "https://site.ru/",
                "lastmod" => "2020-12-14",
                "priority" => 1,
                "changefreq" => "hourly"
            ],
            [
                "loc" => "https://site.ru/jkmjh",
                "lastmod" => "2020-12-14",
                "priority" => 1,
                "changefreq" => "weekly"
            ]
        ];
    }
}
