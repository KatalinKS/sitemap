<?php

namespace KatalinKS\Sitemap\Generators;


use Illuminate\Support\Facades\Storage;
use KatalinKS\Sitemap\Contracts\GeneratorContract;
use KatalinKS\Sitemap\Serializers\Serializer;

class Generator implements GeneratorContract
{
    protected Serializer $serializer;

    public function __construct(protected string $disk, protected string $path)
    {
    }

    public function generate(array $pages): string
    {
        $serializeString = $this->serializer->handle($pages);

        Storage::disk($this->disk)->put($this->path, $serializeString);

        return storage_path($this->disk) . $this->path;
    }

    public function setSerializer(Serializer $serializer): self
    {
        $this->serializer = $serializer;

        return $this;
    }
}
