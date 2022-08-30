<?php

namespace KatalinKS\Sitemap;

use KatalinKS\Sitemap\Contracts\GeneratorContract;
use KatalinKS\Sitemap\Contracts\SitemapContract;

class Sitemap implements SitemapContract
{
    protected GeneratorContract $generator;
    protected array $pages;

    public function setGenerator(GeneratorContract $generator): self
    {
        $this->generator = $generator;

        return $this;
    }

    public function setPages($pages): self
    {
        $this->pages = $pages;

        return $this;
    }

    public function generate(): string
    {
        return $this->generator->generate($this->pages);
    }
}
