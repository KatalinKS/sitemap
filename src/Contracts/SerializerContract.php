<?php

namespace KatalinKS\Sitemap\Contracts;

interface SerializerContract
{
    public function handle(array $pages): string;

    public function setValidator(ValidatorContract $validator): self;

}
