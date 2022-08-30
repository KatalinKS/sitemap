<?php

namespace KatalinKS\Sitemap\Contracts;

interface SitemapContract
{
    public function generate(): string;

    public function setGenerator(GeneratorContract $generator): self;
    public function setPages(array $pages): self;
}
