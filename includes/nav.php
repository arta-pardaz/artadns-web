<?php

declare(strict_types=1);

require_once __DIR__ . '/i18n.php';

$menuConfig = require __DIR__ . '/../config/menu.php';
$currentPage = $currentPage ?? basename($_SERVER['SCRIPT_NAME'], '.php');
$menuItems = $menuConfig['items'];
$cta = $menuConfig['cta'];

function buildMenuLink(array $item, string $currentPage, string $locale): string
{
    $href = localeUrl($locale, $item['href']);
    if ($item['fragment'] !== null) {
        $href .= '#' . $item['fragment'];
    }
    
    $isActive = in_array($currentPage, $item['active'], true);
    $activeAttr = $isActive ? ' aria-current="page"' : '';
    $activeClass = $isActive ? ' active' : '';
    
    return sprintf(
        '<a href="%s" class="nav-link%s"%s>%s</a>',
        htmlspecialchars($href, ENT_QUOTES, 'UTF-8'),
        $activeClass,
        $activeAttr,
        htmlspecialchars(t($item['label']), ENT_QUOTES, 'UTF-8')
    );
}

function buildMobileMenuLink(array $item, string $currentPage, string $locale): string
{
    $href = localeUrl($locale, $item['href']);
    if ($item['fragment'] !== null) {
        $href .= '#' . $item['fragment'];
    }
    
    $isActive = in_array($currentPage, $item['active'], true);
    $activeAttr = $isActive ? ' aria-current="page"' : '';
    $activeClass = $isActive ? ' active' : '';
    
    return sprintf(
        '<li><a href="%s" class="nav-link mobile-link%s"%s>%s</a></li>',
        htmlspecialchars($href, ENT_QUOTES, 'UTF-8'),
        $activeClass,
        $activeAttr,
        htmlspecialchars(t($item['label']), ENT_QUOTES, 'UTF-8')
    );
}

$locale = getLocale();
?>
<nav class="nav-menu" aria-label="<?= t('nav.home') ?>">
    <?php foreach ($menuItems as $item): ?>
        <?= buildMenuLink($item, $currentPage, $locale) ?>
    <?php endforeach; ?>
</nav>

<div class="nav-actions">
    <a href="<?= htmlspecialchars(localeUrl($locale, $cta['href']), ENT_QUOTES, 'UTF-8') ?>" 
       class="<?= htmlspecialchars($cta['class'], ENT_QUOTES, 'UTF-8') ?>">
        <?= htmlspecialchars(t($cta['label']), ENT_QUOTES, 'UTF-8') ?>
    </a>
</div>

<div class="mobile-menu-drawer" id="mobileMenuDrawer">
    <ul>
        <?php foreach ($menuItems as $item): ?>
            <?= buildMobileMenuLink($item, $currentPage, $locale) ?>
        <?php endforeach; ?>
    </ul>
    <a href="<?= htmlspecialchars(localeUrl($locale, $cta['href']), ENT_QUOTES, 'UTF-8') ?>" 
       class="btn btn-primary btn-sm mobile-cta mobile-link">
        <?= htmlspecialchars(t($cta['label']), ENT_QUOTES, 'UTF-8') ?>
    </a>
</div>