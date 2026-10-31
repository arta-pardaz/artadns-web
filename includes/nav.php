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
$localeList = getSupportedLocales();
?>
<nav class="nav-menu" aria-label="<?= htmlspecialchars(t('nav.home'), ENT_QUOTES, 'UTF-8') ?>">
    <?php foreach ($menuItems as $item): ?>
        <?= buildMenuLink($item, $currentPage, $locale) ?>
    <?php endforeach; ?>
</nav>

<div class="nav-actions">
    <div class="lang-dropdown" data-lang-dropdown>
        <button type="button" class="lang-toggle" id="langDropdownToggle" aria-haspopup="true" aria-expanded="false" aria-controls="langDropdownMenu" aria-label="<?= htmlspecialchars(t('common.language'), ENT_QUOTES, 'UTF-8') ?>">
            <svg class="lang-globe" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
            <span class="lang-code"><?= strtoupper($locale) ?></span>
            <svg class="lang-caret" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="lang-menu" id="langDropdownMenu" role="menu">
            <?php foreach ($localeList as $loc): ?>
                <a href="<?= htmlspecialchars(localeUrl($loc), ENT_QUOTES, 'UTF-8') ?>"
                   class="lang-option<?= $loc === $locale ? ' is-active' : '' ?>"
                   hreflang="<?= htmlspecialchars($loc, ENT_QUOTES, 'UTF-8') ?>"
                   role="menuitem"
                   <?= $loc === $locale ? 'aria-current="true"' : '' ?>>
                    <span class="lang-badge"><?= strtoupper($loc) ?></span>
                    <span class="lang-name"><?= htmlspecialchars(t('common.languages.' . $loc), ENT_QUOTES, 'UTF-8') ?></span>
                    <?php if ($loc === $locale): ?>
                        <svg class="lang-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

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

    <div class="mobile-lang">
        <span class="mobile-lang-label"><?= htmlspecialchars(t('common.language'), ENT_QUOTES, 'UTF-8') ?></span>
        <div class="mobile-lang-list">
            <?php foreach ($localeList as $loc): ?>
                <a href="<?= htmlspecialchars(localeUrl($loc), ENT_QUOTES, 'UTF-8') ?>"
                   class="mobile-lang-btn<?= $loc === $locale ? ' is-active' : '' ?>"
                   hreflang="<?= htmlspecialchars($loc, ENT_QUOTES, 'UTF-8') ?>"
                   <?= $loc === $locale ? 'aria-current="true"' : '' ?>>
                    <span class="lang-badge"><?= strtoupper($loc) ?></span>
                    <span class="lang-name"><?= htmlspecialchars(t('common.languages.' . $loc), ENT_QUOTES, 'UTF-8') ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>