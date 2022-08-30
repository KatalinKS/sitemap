<?php

namespace KatalinKS\Sitemap\Exceptions;

use Exception;

class PagesArrayNotValidException extends Exception
{
    public function __construct(string $key, string $value)
    {
        $message = "Неверная структура массива страниц $key => $value";

        parent::__construct($message, 503);
    }
}
