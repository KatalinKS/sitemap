### Sitemap
## Описание пакета
Пакет генерирует карту сайта на основе данных с входного массива.
## Установка
* composer require katalinks/sitemap
* php artisan vendor:publish --provider='KatalinKS\Sitemap\SitemapServiceProvider'

## Настройка
* Отредактировать .env

```
    ...
    APP_URL=https://{{current_domain_name}}

    //Доступные варианты генераторов json_generator, csv_generator, xml_generator
    SITEMAP_GENERATOR=xml_generator
    ...
 ```   
* Реализовать класс для интерфейса (Класс должен возвращать массив с данными страниц заданного формата)

```
    \KatalinKS\Sitemap\Contracts\SitemapDataContract
```
* Зарегистрировать реализацию в сервис провайдере

```
    use KatalinKS\Sitemap\Contracts\SitemapDataContract;
    
    ...
    $this->app->singleton(SitemapDataContract::class, SitemapData::class);
    ...
```
## Запуск

* php artisan sitemap:generate
