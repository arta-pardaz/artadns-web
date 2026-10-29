<?php

declare(strict_types=1);

return [
    'items' => [
        [
            'label' => 'صفحه اصلی',
            'href' => 'index.php',
            'fragment' => null,
            'active' => ['index'],
        ],
        [
            'label' => 'ویژگی‌ها',
            'href' => 'index.php',
            'fragment' => 'features',
            'active' => ['index'],
        ],
        [
            'label' => 'محیط برنامه',
            'href' => 'index.php',
            'fragment' => 'preview',
            'active' => ['index'],
        ],
        [
            'label' => 'دانلود',
            'href' => 'download.php',
            'fragment' => null,
            'active' => ['download'],
        ],
        [
            'label' => 'درباره DNS',
            'href' => 'index.php',
            'fragment' => 'dns',
            'active' => ['index'],
        ],
        [
            'label' => 'DNS GAMING',
            'href' => 'dns-gaming.php',
            'fragment' => null,
            'active' => ['dns-gaming'],
        ],
        [
            'label' => 'سؤالات متداول',
            'href' => 'index.php',
            'fragment' => 'faq',
            'active' => ['index'],
        ],
    ],
    'cta' => [
        'label' => 'دانلود ArtaDNS',
        'href' => 'download.php',
        'class' => 'btn btn-primary btn-sm',
    ],
];