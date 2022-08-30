<?php

namespace KatalinKS\Sitemap\Contracts;

use KatalinKS\Sitemap\Serializers\Serializer;

interface GeneratorContract
{
    public function generate(array $pages): string;

    public function setSerializer(Serializer $serializer): self;
}
