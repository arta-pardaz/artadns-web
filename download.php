<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/i18n.php';

$currentLocale = getLocale();
$canonicalUrl = 'https://artadns.ir' . localeUrl($currentLocale, '/download');
$pageTitle = t('download_page.hero.title') . ' | ' . t('meta.site_name');
$pageDescription = t('download_page.hero.description');
$ogImage = 'https://artadns.ir/logo.png';
$ogType = 'website';
$bodyClass = 'page-download';
$currentPage = 'download';

$schemaDesc = t('schema.business_desc');
$schemaUrl = $canonicalUrl;

$faqItems = [];
foreach (t('download_page.faq.items') as $faq) {
    $faqItems[] = [
        '@type' => 'Question',
        'name' => $faq['q'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => $faq['a']
        ]
    ];
}

$schemaMarkup = <<<SCHEMA
<script type="application/ld+json" id="software-schema">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "ArtaDNS",
  "description": "{$schemaDesc}",
  "url": "{$schemaUrl}",
  "applicationCategory": "NetworkUtility",
  "operatingSystem": "Windows 10, Windows 11",
  "offers": {
    "@type": "Offer",
    "price": "0",
    "priceCurrency": "IRR",
    "availability": "https://schema.org/InStock",
    "url": "https://artadns.ir/downloads/ArtaDNS_v1.0.0.zip"
  },
  "downloadUrl": "https://artadns.ir/downloads/ArtaDNS_v1.0.0.zip",
  "fileSize": "50MB",
  "installUrl": "https://artadns.ir/downloads/ArtaDNS_v1.0.0.zip",
  "version": "1.0.0",
  "datePublished": "2024-01-01",
  "author": {
    "@type": "Organization",
    "name": "ArtaDNS",
    "url": "https://artadns.ir/"
  },
  "publisher": {
    "@type": "Organization",
    "name": "ArtaDNS",
    "logo": {
      "@type": "ImageObject",
      "url": "https://artadns.ir/logo.png"
    }
  },
  "screenshot": "https://artadns.ir/logo.png",
  "softwareRequirements": "Microsoft .NET 6 Desktop Runtime",
  "memoryRequirements": "512MB RAM",
  "storageRequirements": "50MB",
  "processorRequirements": "x64 or x86",
  "inLanguage": "fa-IR"
}
</script>
<script type="application/ld+json" id="webpage-schema">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "DOWNLOAD_PAGE_TITLE",
  "description": "DOWNLOAD_PAGE_DESC",
  "url": "{$schemaUrl}",
  "isPartOf": {
    "@type": "WebSite",
    "name": "ArtaDNS",
    "url": "https://artadns.ir/"
  },
  "about": {
    "@type": "SoftwareApplication",
    "name": "ArtaDNS",
    "applicationCategory": "NetworkUtility",
    "operatingSystem": "Windows 10, Windows 11"
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      {
        "@type": "ListItem",
        "position": 1,
        "name": "SCHEMA_HOME",
        "item": "https://artadns.ir/"
      },
      {
        "@type": "ListItem",
        "position": 2,
        "name": "SCHEMA_DOWNLOAD",
        "item": "{$schemaUrl}"
      }
    ]
  }
}
</script>
<script type="application/ld+json" id="faq-schema">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": FAQ_ITEMS
}
</script>
SCHEMA;

$schemaMarkup = str_replace(
    ['DOWNLOAD_PAGE_TITLE', 'DOWNLOAD_PAGE_DESC', 'SCHEMA_HOME', 'SCHEMA_DOWNLOAD', 'FAQ_ITEMS'],
    [t('download_page.hero.title'), t('download_page.hero.description'), t('footer.links.home'), t('nav.download'), json_encode($faqItems, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)],
    $schemaMarkup
);

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" tabindex="-1">
    <section class="hero-section" id="hero" aria-labelledby="hero-title">
        <div class="container hero-grid">
            <div class="hero-content">
                <div class="hero-badge"><?= t('download_page.hero.badge') ?></div>
                <h1 class="hero-title" id="hero-title"><?= t('download_page.hero.title') ?></h1>
                <p class="hero-subtitle"><?= t('download_page.hero.subtitle') ?></p>
                <p class="hero-desc">
                    <?= t('download_page.hero.description') ?>
                </p>
                <div class="hero-actions">
                    <a href="<?= localeUrl($currentLocale, '/download') ?>#main-download" class="btn btn-primary btn-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <span><?= t('download_page.hero.btn_download') ?></span>
                    </a>
                    <a href="<?= localeUrl($currentLocale, '/') ?>#features" class="btn btn-secondary btn-lg"><?= t('download_page.hero.btn_features') ?></a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-val"><?= t('download_page.hero.stat1.label') ?></span>
                        <span class="stat-label"><?= t('download_page.hero.stat1.desc') ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val"><?= t('download_page.hero.stat2.label') ?></span>
                        <span class="stat-label"><?= t('download_page.hero.stat2.desc') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="download-section" id="main-download">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('download_page.download_section.section_tag') ?></span>
                <h2 class="section-title"><?= t('download_page.download_section.section_title') ?></h2>
                <p class="section-subtitle"><?= t('download_page.download_section.section_subtitle') ?></p>
            </div>

            <div class="download-main-card">
                <span class="version-pill"><?= t('download_page.download_section.version_pill') ?></span>
                <h3 class="download-title"><?= t('download_page.download_section.title') ?></h3>
                <p class="download-meta"><?= t('download_page.download_section.meta') ?></p>
                <div class="download-actions">
                    <a href="https://artadns.ir/downloads/ArtaDNS_v1.0.0.zip" class="btn btn-primary btn-lg" download>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <span><?= t('download_page.download_section.btn_text') ?></span>
                    </a>
                </div>
                <p class="download-hint"><?= t('download_page.download_section.hint') ?></p>
            </div>

            <div class="runtime-box">
                <div class="runtime-notice">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <div>
                        <strong><?= t('download_page.runtime.notice_title') ?></strong>
                        <?= t('download_page.runtime.notice_desc') ?>
                    </div>
                </div>

                <div class="runtime-grid">
                    <div class="runtime-card">
                        <div class="runtime-header">
                            <span class="runtime-title"><?= t('download_page.runtime.x64_title') ?></span>
                            <span class="runtime-desc"><?= t('download_page.runtime.x64_desc') ?></span>
                        </div>
                        <a href="https://artadns.ir/downloads/windowsdesktop-runtime-6.0.10-win-x64.zip" class="btn btn-outline btn-sm" download>
                            <?= t('download_page.runtime.x64_btn') ?>
                        </a>
                    </div>

                    <div class="runtime-card">
                        <div class="runtime-header">
                            <span class="runtime-title"><?= t('download_page.runtime.x86_title') ?></span>
                            <span class="runtime-desc"><?= t('download_page.runtime.x86_desc') ?></span>
                        </div>
                        <a href="https://artadns.ir/downloads/windowsdesktop-runtime-6.0.10-win-x86.zip" class="btn btn-outline btn-sm" download>
                            <?= t('download_page.runtime.x86_btn') ?>
                        </a>
                    </div>
                </div>
            </div>

            <section class="install-guide" style="margin-top: 3rem;">
                <div class="section-header">
                    <span class="section-tag"><?= t('download_page.install_guide.section_tag') ?></span>
                    <h2 class="section-title"><?= t('download_page.install_guide.section_title') ?></h2>
                    <p class="section-subtitle"><?= t('download_page.install_guide.section_subtitle') ?></p>
                </div>

<div class="article-content" style="max-width: 800px; margin: 0 auto; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 2rem;">
                    <h3><?= t('download_page.install_guide.step1_title') ?></h3>
                    <p><?= t('download_page.install_guide.step1_desc') ?></p>

                    <h3><?= t('download_page.install_guide.step2_title') ?></h3>
                    <p><?= t('download_page.install_guide.step2_desc') ?></p>

                    <h3><?= t('download_page.install_guide.step3_title') ?></h3>
                    <p><?= t('download_page.install_guide.step3_desc') ?></p>

                    <h3><?= t('download_page.install_guide.step4_title') ?></h3>
                    <p><?= t('download_page.install_guide.step4_desc') ?></p>

                    <h3><?= t('download_page.install_guide.step5_title') ?></h3>
                    <ul>
                        <?php foreach (t('download_page.install_guide.step5_items') as $item): ?>
                            <li><?= $item ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="runtime-notice" style="margin-top: 1.5rem;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        <div>
                            <strong><?= t('download_page.install_guide.admin_note') ?></strong>
                        </div>
                    </div>
                </div>
            </section>

            <section class="requirements" style="margin-top: 3rem;">
                <div class="section-header">
                    <span class="section-tag"><?= t('download_page.requirements.section_tag') ?></span>
                    <h2 class="section-title"><?= t('download_page.requirements.section_title') ?></h2>
                    <p class="section-subtitle"><?= t('download_page.requirements.section_subtitle') ?></p>
                </div>

                <div class="article-content" style="max-width: 800px; margin: 0 auto; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 2rem;">
                    <ul>
                        <li><?= t('download_page.requirements.os') ?></li>
                        <li><?= t('download_page.requirements.runtime') ?></li>
                        <li><?= t('download_page.requirements.arch') ?></li>
                        <li><?= t('download_page.requirements.ram') ?></li>
                        <li><?= t('download_page.requirements.disk') ?></li>
                        <li><?= t('download_page.requirements.network') ?></li>
                        <li><?= t('download_page.requirements.admin') ?></li>
                    </ul>

                    <h3 style="margin-top: 1.5rem;"><?= t('download_page.requirements.check_arch_title') ?></h3>
                    <p><?= t('download_page.requirements.check_arch_desc') ?></p>
                    <ol>
                        <li><?= t('download_page.requirements.step1') ?></li>
                        <li><?= t('download_page.requirements.step2') ?>
                        <ul>
                            <li><?= t('download_page.requirements.x64_desc2') ?></li>
                            <li><?= t('download_page.requirements.x86_desc2') ?></li>
                        </ul>
                        </li>
                    </ol>
                </div>
            </section>

            <section class="changelog" style="margin-top: 3rem;">
                <div class="section-header">
                    <span class="section-tag"><?= t('download_page.changelog.section_tag') ?></span>
                    <h2 class="section-title"><?= t('download_page.changelog.section_title') ?></h2>
                </div>

                <div class="article-content" style="max-width: 800px; margin: 0 auto; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 2rem;">
                    <h3><?= t('download_page.changelog.features_title') ?></h3>
                    <ul>
                        <?php foreach (t('download_page.changelog.features_list') as $feature): ?>
                            <li><?= $feature ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <h3 style="margin-top: 1.5rem;"><?= t('download_page.changelog.servers_title') ?></h3>
                    <p><?= t('download_page.changelog.servers_desc') ?></p>
                    <ul>
                        <li><?= t('download_page.changelog.internal_servers') ?></li>
                        <li><?= t('download_page.changelog.global_servers') ?></li>
                    </ul>
                </div>
            </section>
        </div>
    </section>

    <section class="faq-section" id="faq">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('download_page.faq.section_tag') ?></span>
                <h2 class="section-title"><?= t('download_page.faq.section_title') ?></h2>
                <p class="section-subtitle"><?= t('download_page.faq.section_subtitle') ?></p>
            </div>

            <div class="faq-list">
                <?php foreach (t('download_page.faq.items') as $index => $faq): ?>
                    <div class="faq-item">
                        <button type="button" class="faq-header" aria-expanded="false" aria-controls="faq-dl-<?= $index + 1 ?>">
                            <span><?= htmlspecialchars($faq['q'], ENT_QUOTES, 'UTF-8') ?></span>
                            <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div class="faq-body" id="faq-dl-<?= $index + 1 ?>">
                            <div class="faq-content">
                                <?= htmlspecialchars($faq['a'], ENT_QUOTES, 'UTF-8') ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="final-cta-section">
        <div class="container">
            <div class="final-cta-box">
                <h2 class="final-cta-title"><?= t('download_page.final_cta.title') ?></h2>
                <p class="final-cta-desc">
                    <?= t('download_page.final_cta.desc') ?>
                </p>
                <a href="https://artadns.ir/downloads/ArtaDNS_v1.0.0.zip" class="btn btn-primary btn-lg" download>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    <span><?= t('download_page.final_cta.btn_text') ?></span>
                </a>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>