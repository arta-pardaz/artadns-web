<?php

declare(strict_types=1);

$menuConfig = require __DIR__ . '/../config/menu.php';
$currentPage = $currentPage ?? basename($_SERVER['SCRIPT_NAME'], '.php');
$menuItems = $menuConfig['items'];
$cta = $menuConfig['cta'];

function buildMenuLink(array $item, string $currentPage): string
{
    $href = $item['href'];
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
        htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8')
    );
}

function buildMobileMenuLink(array $item, string $currentPage): string
{
    $href = $item['href'];
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
        htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8')
    );
}
?>

<nav class="nav-menu" aria-label="منوی اصلی">
    <?php foreach ($menuItems as $item): ?>
        <?= buildMenuLink($item, $currentPage) ?>
    <?php endforeach; ?>
</nav>

<div class="nav-actions">
    <a href="<?= htmlspecialchars($cta['href'], ENT_QUOTES, 'UTF-8') ?>" 
       class="<?= htmlspecialchars($cta['class'], ENT_QUOTES, 'UTF-8') ?>">
        <?= htmlspecialchars($cta['label'], ENT_QUOTES, 'UTF-8') ?>
    </a>
</div>

<div class="mobile-menu-drawer" id="mobileMenuDrawer">
    <ul>
        <?php foreach ($menuItems as $item): ?>
            <?= buildMobileMenuLink($item, $currentPage) ?>
        <?php endforeach; ?>
    </ul>
    <a href="<?= htmlspecialchars($cta['href'], ENT_QUOTES, 'UTF-8') ?>" 
       class="btn btn-primary btn-sm mobile-cta mobile-link">
        <?= htmlspecialchars($cta['label'], ENT_QUOTES, 'UTF-8') ?>
    </a>
</div>