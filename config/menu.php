<?php

declare(strict_types=1);

return [
    'items' => [
        [
            'label' => 'nav.home',
            'href' => '/',
            'fragment' => null,
            'active' => ['index'],
        ],
        [
            'label' => 'nav.features',
            'href' => '/',
            'fragment' => 'features',
            'active' => ['index'],
        ],
        [
            'label' => 'nav.preview',
            'href' => '/',
            'fragment' => 'preview',
            'active' => ['index'],
        ],
        [
            'label' => 'nav.download',
            'href' => '/download',
            'fragment' => null,
            'active' => ['download'],
        ],
        [
            'label' => 'nav.dns_guide',
            'href' => '/',
            'fragment' => 'dns',
            'active' => ['index'],
        ],
        [
            'label' => 'nav.dns_gaming',
            'href' => '/dns-gaming',
            'fragment' => null,
            'active' => ['dns-gaming'],
        ],
        [
            'label' => 'nav.faq',
            'href' => '/',
            'fragment' => 'faq',
            'active' => ['index'],
        ],
    ],
    'cta' => [
        'label' => 'nav.cta_download',
        'href' => '/download',
        'class' => 'btn btn-primary btn-sm',
    ],
];