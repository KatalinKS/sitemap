<?php
return [
    'default_generator' => env('SITEMAP_GENERATOR', 'xml_generator'),

    'generators' => [
        'json_generator' => [
            'serializer' => \KatalinKS\Sitemap\Serializers\ArrayToJson::class,
            'disk' => 'local',
            'path'  => 'sitemaps\sitemap.json'
        ],

        'csv_generator' => [
            'serializer' => \KatalinKS\Sitemap\Serializers\ArrayToCSV::class,
            'disk' => 'local',
            'path'  => 'sitemaps\sitemap.csv'
        ],

        'xml_generator' => [
            'serializer' => \KatalinKS\Sitemap\Serializers\ArrayToXML::class,
            'disk' => 'local',
            'path'  => 'sitemaps\sitemap.xml'
        ],
    ]
];
