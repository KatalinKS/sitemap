<?php

namespace KatalinKS\Sitemap;

use Illuminate\Support\ServiceProvider;
use KatalinKS\Sitemap\Collector\SitemapCollector;
use KatalinKS\Sitemap\Console\Commands\SitemapGeneratorCommand;
use KatalinKS\Sitemap\Contracts\GeneratorContract;
use KatalinKS\Sitemap\Contracts\SerializerContract;
use KatalinKS\Sitemap\Contracts\SitemapContract;
use KatalinKS\Sitemap\Contracts\SitemapDataContract;
use KatalinKS\Sitemap\Contracts\ValidatorContract;
use KatalinKS\Sitemap\Generators\Generator;
use KatalinKS\Sitemap\Validators\DefaultValidatorContract;

class SitemapServiceProvider extends ServiceProvider
{

    public function register()
    {
        $configPath = __DIR__ . '/../config/sitemap.php';
        $this->mergeConfigFrom($configPath, 'sitemap');

        $this->app->singleton(SitemapDataContract::class, SitemapCollector::class);

        $this->app->singleton(ValidatorContract::class, function () {
            return new DefaultValidatorContract(config('app.url'));
        });

        $this->app->singleton(SerializerContract::class, function () {
            $default = config('sitemap.default_generator');

            $serializerClass = config('sitemap.generators.' . $default . '.serializer');

            return new $serializerClass;
        });

        $this->app->singleton(GeneratorContract::class, function () {
            $default = config('sitemap.default_generator');

            $path = config('sitemap.generators.' . $default . '.path');
            $disk = config('sitemap.generators.' . $default . '.disk');

            return new Generator($disk, $path);
        });

        $this->app->singleton(SitemapContract::class, Sitemap::class);
    }

    public function boot(SitemapContract $sitemap, GeneratorContract $generator, SerializerContract $serializer, ValidatorContract $validator, SitemapDataContract $sitemapData)
    {
        $this->publish();

        if ($this->app->runningInConsole()) {
            $this->commands([
                SitemapGeneratorCommand::class,
            ]);
        }

        $serializer
            ->setValidator($validator);

        $generator
            ->setSerializer($serializer);

        $sitemap
            ->setGenerator($generator)
            ->setPages($sitemapData->get());
    }

    protected function publish(): self
    {
        $this->publishes([
            __DIR__ . '/../config/sitemap.php' => config_path('sitemap.php'),
        ]);

        return $this;
    }
}
