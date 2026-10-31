<?php

declare(strict_types=1);

require_once __DIR__ . '/i18n.php';

$currentPage = $currentPage ?? basename($_SERVER['SCRIPT_NAME'], '.php');
$pageTitle = $pageTitle ?? t('meta.site_name') . ' | ' . t('meta.site_name_fa') . ' - ' . t('meta.tagline');
$pageDescription = $pageDescription ?? t('meta.description');
$canonicalUrl = $canonicalUrl ?? 'https://artadns.ir' . localeUrl(getLocale());
$ogImage = $ogImage ?? 'https://artadns.ir/logo.png';
$ogType = $ogType ?? 'website';
$bodyClass = $bodyClass ?? 'page-home';
$schemaMarkup = $schemaMarkup ?? '';
$currentLocale = getLocale();
$currentDir = getLocaleDir();
$currentLang = getLocaleLang();
$hreflangUrls = hreflangUrls();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($currentLang, ENT_QUOTES, 'UTF-8') ?>" dir="<?= htmlspecialchars($currentDir, ENT_QUOTES, 'UTF-8') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta name="theme-color" content="#16a34a">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8') ?>">
    <?php foreach ($hreflangUrls as $locale => $url): ?>
        <link rel="alternate" hreflang="<?= $locale === 'x-default' ? 'x-default' : $locale ?>" href="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>">
    <?php endforeach; ?>
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="preconnect" href="https://artadns.ir">
    <link rel="dns-prefetch" href="https://artadns.ir">
    <link rel="preload" as="font" type="font/woff2" crossorigin href="fonts/Vazirmatn-Regular.woff2">
    <link rel="preload" as="font" type="font/woff2" crossorigin href="fonts/Vazirmatn-Medium.woff2">
    <link rel="preload" as="font" type="font/woff2" crossorigin href="fonts/Vazirmatn-SemiBold.woff2">

    <!-- Open Graph / Social Sharing -->
    <meta property="og:type" content="<?= htmlspecialchars($ogType, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:site_name" content="ArtaDNS">
    <meta property="og:locale" content="<?= htmlspecialchars(['fa' => 'fa_IR', 'en' => 'en_US', 'ar' => 'ar_AR', 'ur' => 'ur_PK', 'tr' => 'tr_TR', 'fr' => 'fr_FR'][$currentLocale] ?? 'fa_IR', ENT_QUOTES, 'UTF-8') ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8') ?>">
    <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8') ?>">
    <meta name="twitter:image:alt" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">

    <?= $schemaMarkup ?>

    <link rel="preload" href="css/style.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="css/style.css"></noscript>
    <link rel="manifest" href="site.webmanifest">
</head>
<body class="<?= htmlspecialchars($bodyClass, ENT_QUOTES, 'UTF-8') ?>">

    <!-- Header -->
    <header class="site-header">
        <div class="container nav-wrapper">
            <a href="<?= localeUrl($currentLocale, '/') ?>" class="brand">
                <img src="images/logo.png" data-remote-url="https://artadns.ir/logo.png" alt="لوگوی ArtaDNS" class="brand-logo" width="36" height="36">
                <div class="brand-text">
                    <span class="brand-title">ArtaDNS</span>
                    <span class="brand-tagline"><?= t('meta.site_name_fa') ?></span>
                </div>
            </a>

            <?php require __DIR__ . '/nav.php'; ?>

            <button type="button" class="mobile-nav-toggle" id="mobileNavToggle" aria-label="<?= t('common.close') ?>" aria-expanded="false" aria-controls="mobileMenuDrawer">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>