<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/i18n.php';

$currentLocale = getLocale();
$canonicalUrl = 'https://artadns.ir' . localeUrl($currentLocale, '/dns-gaming');
$pageTitle = t('gaming_page.hero.title') . ' | ' . t('meta.site_name');
$pageDescription = t('gaming_page.hero.description');
$ogImage = 'https://artadns.ir/logo.png';
$ogType = 'article';
$bodyClass = 'page-gaming';
$currentPage = 'dns-gaming';

$schemaUrl = $canonicalUrl;
$schemaHome = t('footer.links.home');
$schemaGaming = t('nav.dns_gaming');

$faqItems = [];
foreach (t('gaming_page.faq.items') as $faq) {
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
<script type="application/ld+json" id="article-schema">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "ARTICLE_HEADLINE",
  "description": "ARTICLE_DESC",
  "url": "{$schemaUrl}",
  "image": "https://artadns.ir/logo.png",
  "datePublished": "2024-01-01T00:00:00+03:30",
  "dateModified": "2024-01-01T00:00:00+03:30",
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
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{$schemaUrl}"
  },
  "articleSection": "Gaming Guide",
  "keywords": ["DNS", "Gaming", "Ping", "Optimization", "ArtaDNS"],
  "inLanguage": "LANG_CODE"
}
</script>
<script type="application/ld+json" id="webpage-schema">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "WEBPAGE_NAME",
  "description": "WEBPAGE_DESC",
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
        "name": "{$schemaHome}",
        "item": "https://artadns.ir/"
      },
      {
        "@type": "ListItem",
        "position": 2,
        "name": "{$schemaGaming}",
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
    ['ARTICLE_HEADLINE', 'ARTICLE_DESC', 'WEBPAGE_NAME', 'WEBPAGE_DESC', 'LANG_CODE', 'FAQ_ITEMS'],
    [t('gaming_page.hero.title'), t('gaming_page.hero.description'), t('gaming_page.hero.title'), t('gaming_page.hero.description'), $currentLocale === 'fa' ? 'fa-IR' : ($currentLocale . '-' . strtoupper($currentLocale)), json_encode($faqItems, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)],
    $schemaMarkup
);

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" tabindex="-1">
    <section class="hero-section gaming-hero" id="hero" aria-labelledby="hero-title">
        <div class="container hero-grid">
            <div class="hero-content">
                <div class="hero-badge"><?= t('gaming_page.hero.badge') ?></div>
                <h1 class="hero-title" id="hero-title"><?= t('gaming_page.hero.title') ?></h1>
                <p class="hero-subtitle"><?= t('gaming_page.hero.subtitle') ?></p>
                <p class="hero-desc">
                    <?= t('gaming_page.hero.description') ?>
                </p>
                <div class="hero-actions">
                    <a href="<?= localeUrl($currentLocale, '/download') ?>" class="btn btn-primary btn-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <span><?= t('gaming_page.hero.btn_download') ?></span>
                    </a>
                </div>
            </div>

<div class="hero-visual">
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-val"><?= t('gaming_page.hero.stat1.label') ?></span>
                    <span class="stat-label"><?= t('gaming_page.hero.stat1.desc') ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-val"><?= t('gaming_page.hero.stat2.label') ?></span>
                    <span class="stat-label"><?= t('gaming_page.hero.stat2.desc') ?></span>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="features-section" id="dns-explained">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('gaming_page.dns_explained.section_tag') ?></span>
                <h2 class="section-title"><?= t('gaming_page.dns_explained.section_title') ?></h2>
            </div>

            <div class="article-content">
                <p><?= t('gaming_page.dns_explained.desc') ?></p>
            </div>
        </div>
    </section>

    <section class="dns-table-section" id="internal-dns">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('gaming_page.internal_dns.section_tag') ?></span>
                <h2 class="section-title" id="internal-dns-title"><?= t('gaming_page.internal_dns.section_title') ?></h2>
                <p class="section-subtitle"><?= t('gaming_page.internal_dns.section_subtitle') ?></p>
            </div>

            <div class="table-wrapper" tabindex="0" role="region" aria-label="جدول سرورهای DNS">
                <table class="dns-table">
                    <thead>
                        <tr>
                            <?php foreach (t('gaming_page.internal_dns.table_headers') as $header): ?>
                                <th scope="col"><?= htmlspecialchars($header, ENT_QUOTES, 'UTF-8') ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (t('gaming_page.internal_dns.table_data') as $row): ?>
                            <tr>
                                <?php foreach ($row as $cell): ?>
                                    <td><?= htmlspecialchars($cell, ENT_QUOTES, 'UTF-8') ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <p class="table-note"><?= t('gaming_page.internal_dns.note') ?></p>
        </div>
    </section>

    <section class="dns-table-section" id="global-dns">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('gaming_page.global_dns.section_tag') ?></span>
                <h2 class="section-title" id="global-dns-title"><?= t('gaming_page.global_dns.section_title') ?></h2>
                <p class="section-subtitle"><?= t('gaming_page.global_dns.section_subtitle') ?></p>
            </div>

            <div class="table-wrapper" tabindex="0" role="region" aria-label="جدول سرورهای DNS">
                <table class="dns-table">
                    <thead>
                        <tr>
                            <?php foreach (t('gaming_page.global_dns.table_headers') as $header): ?>
                                <th scope="col"><?= htmlspecialchars($header, ENT_QUOTES, 'UTF-8') ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (t('gaming_page.global_dns.table_data') as $row): ?>
                            <tr>
                                <?php foreach ($row as $cell): ?>
                                    <td><?= htmlspecialchars($cell, ENT_QUOTES, 'UTF-8') ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <p class="table-note"><?= t('gaming_page.global_dns.note') ?></p>
        </div>
    </section>

    <section class="article-section" id="manual-testing">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('gaming_page.manual_testing.section_tag') ?></span>
                <h2 class="section-title"><?= t('gaming_page.manual_testing.section_title') ?></h2>
            </div>

            <div class="article-content">
                <p><?= t('gaming_page.manual_testing.desc') ?></p>
                
                <h3><?= t('gaming_page.manual_testing.manual_method') ?></h3>
                <ol>
                    <?php foreach (t('gaming_page.manual_testing.steps') as $step): ?>
                        <li><?= $step ?></li>
                    <?php endforeach; ?>
                </ol>
                
                <p><?= t('gaming_page.manual_testing.alternative') ?></p>
            </div>
        </div>
    </section>

    <section class="artadns-solution" id="artadns-solution">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('gaming_page.artadns_solution.section_tag') ?></span>
                <h2 class="section-title"><?= t('gaming_page.artadns_solution.section_title') ?></h2>
            </div>

            <div class="solution-content">
                <div class="solution-text">
                    <p><?= t('gaming_page.artadns_solution.desc') ?></p>
                    
                    <h3><?= t('gaming_page.artadns_solution.benefits_title') ?></h3>
                    <ul>
                        <?php foreach (t('gaming_page.artadns_solution.benefits') as $benefit): ?>
                            <li><?= $benefit ?></li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <p><?= t('gaming_page.artadns_solution.runtime_note') ?></p>
                </div>
                
                <div class="solution-cta">
                    <a href="<?= localeUrl($currentLocale, '/download') ?>" class="btn btn-primary btn-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <span><?= t('gaming_page.artadns_solution.btn_download') ?></span>
                    </a>
                    <p class="download-hint"><?= t('gaming_page.artadns_solution.hint') ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="article-section" id="security">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('gaming_page.security.section_tag') ?></span>
                <h2 class="section-title"><?= t('gaming_page.security.section_title') ?></h2>
            </div>

            <div class="article-content">
                <p><?= t('gaming_page.security.desc') ?></p>
                
                <h3><?= t('gaming_page.security.tips_title') ?></h3>
                <ul>
                    <?php foreach (t('gaming_page.security.tips') as $tip): ?>
                        <li><?= $tip ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>

    <section class="article-section" id="final-recommendation">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('gaming_page.final_recommendation.section_tag') ?></span>
                <h2 class="section-title"><?= t('gaming_page.final_recommendation.section_title') ?></h2>
            </div>

            <div class="article-content">
                <ul class="recommendation-list">
                    <?php foreach (t('gaming_page.final_recommendation.items') as $item): ?>
                        <li><?= $item ?></li>
                    <?php endforeach; ?>
                </ul>
                
                <p><?= t('gaming_page.final_recommendation.conclusion') ?></p>
            </div>
        </div>
    </section>

    <section class="download-section" id="download">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('gaming_page.download_section.section_tag') ?></span>
                <h2 class="section-title"><?= t('gaming_page.download_section.section_title') ?></h2>
                <p class="section-subtitle"><?= t('gaming_page.download_section.section_subtitle') ?></p>
            </div>

            <div class="download-main-card" style="max-width: 600px; margin: 0 auto; text-align: center;">
                <span class="version-pill"><?= t('gaming_page.download_section.version_pill') ?></span>
                <h3 class="download-title"><?= t('gaming_page.download_section.title') ?></h3>
                <p class="download-meta"><?= t('gaming_page.download_section.meta') ?></p>
                <div class="download-actions">
                    <a href="<?= localeUrl($currentLocale, '/download') ?>" class="btn btn-primary btn-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <span><?= t('gaming_page.download_section.btn_text') ?></span>
                    </a>
                </div>
                <p class="download-hint"><?= t('gaming_page.download_section.hint') ?></p>
            </div>
        </div>
    </section>

    <section class="faq-section" id="faq">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('gaming_page.faq.section_tag') ?></span>
                <h2 class="section-title"><?= t('gaming_page.faq.section_title') ?></h2>
                <p class="section-subtitle"><?= t('gaming_page.faq.section_subtitle') ?></p>
            </div>

            <div class="faq-list">
                <?php foreach (t('gaming_page.faq.items') as $index => $faq): ?>
                    <div class="faq-item">
                        <button type="button" class="faq-header" aria-expanded="false" aria-controls="faq-gm-<?= $index + 1 ?>">
                            <span><?= htmlspecialchars($faq['q'], ENT_QUOTES, 'UTF-8') ?></span>
                            <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div class="faq-body" id="faq-gm-<?= $index + 1 ?>">
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
                <h2 class="final-cta-title"><?= t('gaming_page.final_cta.title') ?></h2>
                <p class="final-cta-desc">
                    <?= t('gaming_page.final_cta.desc') ?>
                </p>
                <a href="<?= localeUrl($currentLocale, '/download') ?>" class="btn btn-primary btn-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    <span><?= t('gaming_page.final_cta.btn_text') ?></span>
                </a>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>