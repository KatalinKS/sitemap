<?php

namespace KatalinKS\Sitemap\Serializers;

class ArrayToJson extends Serializer
{
    protected function serialize(array $pages): string
    {
        return collect($pages)->toJson();
    }
}
