<?php

namespace KatalinKS\Sitemap\Contracts;

interface ValidatorContract
{
    public function validate(array $array): bool;
}
