<?php

namespace KatalinKS\Sitemap\Validators;

use KatalinKS\Sitemap\Contracts\ValidatorContract;
use KatalinKS\Sitemap\Exceptions\PagesArrayNotValidException;

class DefaultValidatorContract implements ValidatorContract
{
    public function __construct(private string $domain)
    {
    }

    public function validate(array $array): bool
    {
        collect($array)->each(function ($item) {
            foreach ($this->getRules() as $attr => $rule) {
                if (!preg_match($rule, $item[$attr])) {
                    throw new PagesArrayNotValidException($attr, $item[$attr]);
                }
            }
        });

        return true;
    }

    protected function getRules(): array
    {
        $domain = preg_quote($this->domain);

        return [
            'loc' => "~^" . $domain . "~",
            'lastmod' => "/^[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/",
            'priority' => "/(^[0].[0-9]*$)|(^1$)/",
            'changefreq' => "/(^daily$)|(^weekly$)|(^hourly$)/",
        ];
    }
}
