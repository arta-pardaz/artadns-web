<?php

declare(strict_types=1);

$supportedLocales = ['fa', 'en', 'ar', 'ur', 'tr', 'fr'];
$defaultLocale = 'fa';
$rtlLocales = ['fa', 'ar', 'ur'];

function detectLocale(): string
{
    global $supportedLocales, $defaultLocale;

    if (isset($_GET['lang']) && in_array($_GET['lang'], $supportedLocales, true)) {
        $_SESSION['locale'] = $_GET['lang'];
        return $_GET['lang'];
    }

    if (isset($_SESSION['locale']) && in_array($_SESSION['locale'], $supportedLocales, true)) {
        return $_SESSION['locale'];
    }

    $acceptLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
    if ($acceptLang) {
        $langs = [];
        foreach (explode(',', $acceptLang) as $part) {
            $part = trim($part);
            if (preg_match('/^([a-z]{2})(?:-[A-Z]{2})?(?:;q=([0-9.]+))?$/i', $part, $m)) {
                $lang = strtolower($m[1]);
                $quality = isset($m[2]) ? (float)$m[2] : 1.0;
                $langs[$lang] = $quality;
            }
        }
        arsort($langs);
        foreach ($langs as $lang => $q) {
            if (in_array($lang, $supportedLocales, true)) {
                return $lang;
            }
        }
    }

    return $defaultLocale;
}

function getLocale(): string
{
    static $locale = null;
    if ($locale === null) {
        $locale = detectLocale();
    }
    return $locale;
}

function isRTL(string $locale = ''): bool
{
    global $rtlLocales;
    $locale = $locale ?: getLocale();
    return in_array($locale, $rtlLocales, true);
}

function getLocaleDir(string $locale = ''): string
{
    return isRTL($locale) ? 'rtl' : 'ltr';
}

function getLocaleLang(string $locale = ''): string
{
    $locale = $locale ?: getLocale();
    $map = [
        'fa' => 'fa',
        'en' => 'en',
        'ar' => 'ar',
        'ur' => 'ur',
        'tr' => 'tr',
        'fr' => 'fr',
    ];
    return $map[$locale] ?? 'fa';
}

function loadTranslations(string $locale): array
{
    static $translations = [];

    if (!isset($translations[$locale])) {
        $file = __DIR__ . '/../lang/' . $locale . '.php';
        $translations[$locale] = file_exists($file) ? require $file : [];
    }

    return $translations[$locale];
}

function lookupTranslation(array $translations, string $key): mixed
{
    $value = $translations;

    foreach (explode('.', $key) as $k) {
        if (is_array($value) && array_key_exists($k, $value)) {
            $value = $value[$k];
        } else {
            return null;
        }
    }

    return $value;
}

function t(string $key, array $params = []): mixed
{
    $locale = getLocale();
    $value = lookupTranslation(loadTranslations($locale), $key);

    if ($value === null && $locale !== 'fa') {
        $value = lookupTranslation(loadTranslations('fa'), $key);
    }

    if ($value === null) {
        return $key;
    }

    if (is_string($value)) {
        foreach ($params as $paramKey => $paramValue) {
            $value = str_replace('{' . $paramKey . '}', (string) $paramValue, $value);
        }
    }

    return $value;
}

function normalizePath(string $path): string
{
    global $supportedLocales;

    $path = parse_url($path, PHP_URL_PATH) ?? '/';

    if ($path === '') {
        $path = '/';
    }

    if ($path[0] !== '/') {
        $path = '/' . $path;
    }

    $pattern = '#^/(' . implode('|', $supportedLocales) . ')(?=/|$)#';
    $stripped = preg_replace($pattern, '', $path);

    if ($stripped === null || $stripped === '') {
        $stripped = '/';
    }

    if ($stripped[0] !== '/') {
        $stripped = '/' . $stripped;
    }

    return $stripped;
}

function localeUrl(string $targetLocale, string $currentPath = ''): string
{
    global $supportedLocales, $defaultLocale;

    if (!in_array($targetLocale, $supportedLocales, true)) {
        $targetLocale = $defaultLocale;
    }

    $path = normalizePath($currentPath !== '' ? $currentPath : ($_SERVER['REQUEST_URI'] ?? '/'));

    if ($targetLocale === $defaultLocale) {
        return $path;
    }

    return '/' . $targetLocale . ($path === '/' ? '/' : $path);
}

function hreflangUrls(): array
{
    global $supportedLocales, $defaultLocale;

    $urls = [];
    $currentPath = normalizePath($_SERVER['REQUEST_URI'] ?? '/');
    $baseUrl = 'https://artadns.ir';

    foreach ($supportedLocales as $locale) {
        $urls[$locale] = $baseUrl . localeUrl($locale, $currentPath);
    }

    $urls['x-default'] = $baseUrl . localeUrl($defaultLocale, $currentPath);

    return $urls;
}

function getSupportedLocales(): array
{
    global $supportedLocales;
    return $supportedLocales;
}

function getDefaultLocale(): string
{
    global $defaultLocale;
    return $defaultLocale;
}

session_start();
$currentLocale = getLocale();
$currentDir = getLocaleDir();
$currentLang = getLocaleLang();