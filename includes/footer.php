<?php

declare(strict_types=1);

require_once __DIR__ . '/i18n.php';

$currentLocale = getLocale();
$supportedLocales = getSupportedLocales();
?>
    <!-- Footer -->
    <footer class="site-footer" id="contact">
        <div class="container footer-grid">
            <div class="footer-brand">
                <span class="footer-brand-title"><?= t('footer.brand') ?> | <?= t('meta.site_name_fa') ?></span>
                <p class="footer-desc">
                    <?= t('footer.tagline') ?>
                </p>
                <p class="footer-desc">
                    <?= t('footer.official_site') ?> <a href="https://artapardaz.com/" target="_blank" rel="noopener noreferrer">artapardaz.com</a>
                </p>
            </div>

            <div>
                <h2 class="footer-section-title"><?= t('footer.contact_info') ?></h2>
                <div class="footer-contact-list">
                    <div class="footer-contact-item">
                        <span><?= t('footer.phone') ?>:</span>
                        <a href="tel:03195010380" dir="ltr">031-95010380</a>
                    </div>
                    <div class="footer-contact-item">
                        <span><?= t('footer.address') ?>:</span>
                        <span><?= t('schema.address') ?></span>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="footer-section-title"><?= t('footer.social') ?></h2>
                <div class="footer-messengers">
                    <a href="https://eitaa.com/ArtaPardaz" class="messenger-link" target="_blank" rel="noopener noreferrer">
                        <span>ایتا (Eitaa)</span>
                    </a>
                    <a href="https://ble.ir/ARTAPARDAZSEPAHAN" class="messenger-link" target="_blank" rel="noopener noreferrer">
                        <span>بله (Bale)</span>
                    </a>
                    <a href="https://rubika.com/Artapardaz" class="messenger-link" target="_blank" rel="noopener noreferrer">
                        <span>روبیکا (Rubika)</span>
                    </a>
                </div>
            </div>

            <div class="footer-lang">
                <h2 class="footer-section-title"><?= t('common.language') ?></h2>
                <div class="lang-switcher">
                    <?php foreach ($supportedLocales as $locale): 
                        $langName = t('common.languages.' . $locale);
                        $isActive = $locale === $currentLocale;
                        $url = localeUrl($locale);
                    ?>
                        <a href="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>" 
                           class="lang-btn<?= $isActive ? ' active' : '' ?>"
                           hreflang="<?= $locale ?>"
                           <?= $isActive ? 'aria-current="page"' : '' ?>>
                            <span class="lang-badge"><?= strtoupper($locale) ?></span>
                            <span class="lang-name"><?= htmlspecialchars($langName, ENT_QUOTES, 'UTF-8') ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="container footer-bottom">
            <div>&copy; 2026 <?= t('footer.brand') ?>. <?= t('footer.copyright') ?></div>
            <div>
                <a href="https://artapardaz.com/" target="_blank" rel="noopener noreferrer"><?= t('footer.made_by') ?></a>
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>