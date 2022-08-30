<?php

namespace KatalinKS\Sitemap\Serializers;

use DOMDocument;

class ArrayToXML extends Serializer
{
    protected bool $formatOutputXML = true;
    protected array $urlAttr = [
        'loc',
        'lastmod',
        'priority',
        'changefreq'
    ];

    protected array $urlsetAttr = [
        'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
        'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
        'xsi:schemaLocation' => 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd',
    ];

    protected function serialize(array $pages): string
    {
        $dom = new DOMDocument('1.0', 'UTF-8');

        $urlset = $this->generateUrlset($dom, $pages);

        $dom->appendChild($urlset);

        $dom->formatOutput = $this->formatOutputXML;

        return $dom->saveXML();
    }

    protected function generateUrl(DOMDocument $dom, array $page): \DOMElement
    {
        $url = $dom->createElement('url');

        foreach ($this->urlAttr as $attr) {
            $loc = $dom->createElement($attr);
            $text = $dom->createTextNode($page[$attr]);
            $loc->appendChild($text);
            $url->appendChild($loc);
        }

        return $url;
    }

    protected function generateUrlset(DOMDocument $dom, array $pages): \DOMElement
    {
        $urlset = $dom->createElement('urlset');

        foreach ($this->urlsetAttr as $key => $value) {
            $urlset->setAttribute($key, $value);
        }

        foreach ($pages as $page) {
            $url = $this->generateUrl($dom, $page);

            $urlset->appendChild($url);
        }

        return $urlset;
    }


}
