<?php

namespace KatalinKS\Sitemap\Serializers;

use KatalinKS\Sitemap\Contracts\SerializerContract;
use KatalinKS\Sitemap\Contracts\ValidatorContract;
use KatalinKS\Sitemap\Exceptions\PagesArrayNotValidException;

abstract class Serializer implements SerializerContract
{
    protected ValidatorContract $validator;

    public function handle(array $pages): string
    {
        if ($this->validator->validate($pages)) {
            return $this->serialize($pages);
        } else {
            throw new PagesArrayNotValidException();
        }
    }

    abstract protected function serialize(array $pages): string;

    public function setValidator(ValidatorContract $validator): self
    {
        $this->validator = $validator;

        return $this;
    }


}
