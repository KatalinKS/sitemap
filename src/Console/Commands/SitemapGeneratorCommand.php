<?php

namespace KatalinKS\Sitemap\Console\Commands;

use Illuminate\Console\Command;
use KatalinKS\Sitemap\Contracts\SitemapContract;

class SitemapGeneratorCommand extends Command
{
    public function __construct(protected SitemapContract $sitemap)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Генерация карты сайта';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Запуск генератора карты сайтов');

        $path = $this->sitemap->generate();

        $this->info('Карта сайта сгенерирована по адресу '. $path);

        $this->info('Генерация успешно завершена');
        return 0;
    }
}
