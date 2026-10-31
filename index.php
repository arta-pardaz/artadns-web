<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/i18n.php';

$currentLocale = getLocale();
$canonicalUrl = 'https://artadns.ir' . localeUrl($currentLocale);
$pageTitle = t('meta.site_name') . ' | ' . t('meta.site_name_fa') . ' - ' . t('meta.tagline');
$pageDescription = t('meta.description');
$ogImage = 'https://artadns.ir/logo.png';
$ogType = 'website';
$bodyClass = 'page-home';
$currentPage = 'index';

$schemaMarkup = <<<'SCHEMA'
<script type="application/ld+json" id="google-schema-markup">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "ArtaDNS",
  "description": "SCHEMA_DESC",
  "url": "SCHEMA_URL",
  "logo": "https://artadns.ir/logo.png",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "SCHEMA_ADDRESS",
    "addressLocality": "SCHEMA_CITY",
    "postalCode": "123456"
  },
  "telephone": "+98 31 95010380",
  "email": "info@artadns.ir",
  "areaServed": "IR",
  "priceRange": "Free",
  "openingHours": [
    "09:00",
    "18:00"
  ],
  "sameAs": "https://artapardaz.com/"
}
</script>
<script type="application/ld+json" id="google-organization">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "ArtaDNS",
  "description": "SCHEMA_DESC",
  "url": "SCHEMA_URL",
  "logo": "https://artadns.ir/logo.png",
  "sameAs": "https://artapardaz.com/",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+98 31 95010380",
    "email": "info@artadns.ir"
  }
}
</script>
<script type="application/ld+json" id="google-product">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "ArtaDNS",
  "description": "SCHEMA_PRODUCT_DESC",
  "url": "SCHEMA_URL",
  "image": "https://artadns.ir/logo.png",
  "offers": {
    "@type": "Offer",
    "price": "0",
    "priceCurrency": "IRR",
    "availability": "https://schema.org/InStock",
    "shippingDetails": {
      "@type": "OfferShippingDetails",
      "shippingRate": {
        "@type": "MonetaryAmount",
        "value": "0",
        "currency": "IRR"
      },
      "shippingDestination": {
        "@type": "DefinedRegion",
        "addressCountry": "IR"
      },
      "deliveryTime": {
        "@type": "ShippingDeliveryTime",
        "handlingTime": {
          "@type": "QuantitativeValue",
          "minValue": 0,
          "maxValue": 0,
          "unitCode": "DAY"
        },
        "transitTime": {
          "@type": "QuantitativeValue",
          "minValue": 0,
          "maxValue": 0,
          "unitCode": "DAY"
        }
      }
    },
    "hasMerchantReturnPolicy": {
      "@type": "MerchantReturnPolicy",
      "returnPolicyCategory": "https://schema.org/MerchantReturnFiniteReturnPolicy",
      "merchantReturnDays": 30,
      "returnMethod": "https://schema.org/ReturnMethodRefund",
      "returnFees": "https://schema.org/FreeReturnFees"
    }
  },
  "brand": {
    "@type": "Brand",
    "name": "ArtaDNS"
  }
}
</script>
<script type="application/ld+json" id="webpage-schema">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "SCHEMA_PAGE_NAME",
  "description": "SCHEMA_PAGE_DESC",
  "url": "SCHEMA_URL",
  "isPartOf": {
    "@type": "WebSite",
    "name": "ArtaDNS",
    "url": "https://artadns.ir/"
  },
  "about": {
    "@type": "SoftwareApplication",
    "name": "ArtaDNS",
    "applicationCategory": "NetworkUtility",
    "operatingSystem": "Windows 10, Windows 11",
    "offers": {
      "@type": "Offer",
      "price": "0",
      "priceCurrency": "IRR"
    }
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      {
        "@type": "ListItem",
        "position": 1,
        "name": "SCHEMA_HOME",
        "item": "SCHEMA_URL"
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

$schemaDesc = t('schema.business_desc');
$schemaUrl = $canonicalUrl;
$schemaAddress = t('schema.address');
$schemaCity = t('schema.city');
$schemaProductDesc = t('schema.business_desc');
$schemaPageName = t('meta.site_name') . ' - ' . t('footer.links.home');
$schemaPageDesc = t('meta.description');
$schemaHome = t('footer.links.home');

$faqItems = [];
foreach (t('faq.items') as $index => $faq) {
    $faqItems[] = [
        '@type' => 'Question',
        'name' => $faq['q'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => $faq['a']
        ]
    ];
}

$schemaMarkup = str_replace(
    ['SCHEMA_DESC', 'SCHEMA_URL', 'SCHEMA_ADDRESS', 'SCHEMA_CITY', 'SCHEMA_PRODUCT_DESC', 'SCHEMA_PAGE_NAME', 'SCHEMA_PAGE_DESC', 'SCHEMA_HOME', 'FAQ_ITEMS'],
    [$schemaDesc, $schemaUrl, $schemaAddress, $schemaCity, $schemaProductDesc, $schemaPageName, $schemaPageDesc, $schemaHome, json_encode($faqItems, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)],
    $schemaMarkup
);

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" tabindex="-1">
    <!-- Hero Section -->
    <section class="hero-section" id="hero" aria-labelledby="hero-title">
        <div class="container hero-grid">
            <div class="hero-content">
                <div class="hero-badge"><?= t('hero.badge') ?></div>
                <h1 class="hero-title" id="hero-title"><?= t('hero.title') ?></h1>
                <p class="hero-subtitle"><?= t('hero.subtitle') ?></p>
                <p class="hero-desc">
                    <?= t('hero.description') ?>
                </p>
                <div class="hero-actions">
                    <a href="<?= localeUrl($currentLocale, '/download') ?>" class="btn btn-primary btn-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <span><?= t('hero.btn_download') ?></span>
                    </a>
                    <a href="<?= localeUrl($currentLocale, '/') ?>#features" class="btn btn-secondary btn-lg"><?= t('hero.btn_features') ?></a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-val"><?= t('hero.stat1_label') ?></span>
                        <span class="stat-label"><?= t('hero.stat1_desc') ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val"><?= t('hero.stat2_label') ?></span>
                        <span class="stat-label"><?= t('hero.stat2_desc') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('features.section_tag') ?></span>
                <h2 class="section-title"><?= t('features.section_title') ?></h2>
                <p class="section-subtitle"><?= t('features.section_subtitle') ?></p>
            </div>

            <div class="features-grid">
                <!-- Feature 1 -->
                <article class="feature-card">
                    <div class="feature-icon-wrapper" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    </div>
                    <h3 class="feature-title"><?= t('features.feature1.title') ?></h3>
                    <p class="feature-desc"><?= t('features.feature1.desc') ?></p>
                </article>

                <!-- Feature 2 -->
                <article class="feature-card">
                    <div class="feature-icon-wrapper" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <h3 class="feature-title"><?= t('features.feature2.title') ?></h3>
                    <p class="feature-desc"><?= t('features.feature2.desc') ?></p>
                </article>

                <!-- Feature 3 -->
                <article class="feature-card">
                    <div class="feature-icon-wrapper" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/></svg>
                    </div>
                    <h3 class="feature-title"><?= t('features.feature3.title') ?></h3>
                    <p class="feature-desc"><?= t('features.feature3.desc') ?></p>
                </article>

                <!-- Feature 4 -->
                <article class="feature-card">
                    <div class="feature-icon-wrapper" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="feature-title"><?= t('features.feature4.title') ?></h3>
                    <p class="feature-desc"><?= t('features.feature4.desc') ?></p>
                </article>
            </div>
        </div>
    </section>

    <!-- App Preview Section -->
    <section class="preview-section" id="preview">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('preview.section_tag') ?></span>
                <h2 class="section-title"><?= t('preview.section_title') ?></h2>
                <p class="section-subtitle"><?= t('preview.section_subtitle') ?></p>
            </div>

            <div class="preview-wrapper">
                <div class="preview-details">
                    <div class="preview-item">
                        <h3 class="preview-item-title"><?= t('preview.item1.title') ?></h3>
                        <p class="preview-item-desc"><?= t('preview.item1.desc') ?></p>
                    </div>
                    <div class="preview-item">
                        <h3 class="preview-item-title"><?= t('preview.item2.title') ?></h3>
                        <p class="preview-item-desc"><?= t('preview.item2.desc') ?></p>
                    </div>
                    <div class="preview-item">
                        <h3 class="preview-item-title"><?= t('preview.item3.title') ?></h3>
                        <p class="preview-item-desc"><?= t('preview.item3.desc') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Download CTA Section -->
    <section class="download-section" id="download">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('download.section_tag') ?></span>
                <h2 class="section-title"><?= t('download.section_title') ?></h2>
                <p class="section-subtitle"><?= t('download.section_subtitle') ?></p>
            </div>

            <div class="download-main-card" style="max-width: 600px; margin: 0 auto; text-align: center;">
                <span class="version-pill"><?= t('download.version_pill') ?></span>
                <h3 class="download-title"><?= t('download.title') ?></h3>
                <p class="download-meta"><?= t('download.meta') ?></p>
                <div class="download-actions">
                    <a href="<?= localeUrl($currentLocale, '/download') ?>" class="btn btn-primary btn-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <span><?= t('download.btn_text') ?></span>
                    </a>
                </div>
                <p class="download-hint"><?= t('download.hint') ?></p>
            </div>
        </div>
    </section>

    <!-- DNS Guide Section -->
    <section class="dns-section" id="dns">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('dns_guide.section_tag') ?></span>
                <h2 class="section-title"><?= t('dns_guide.section_title') ?></h2>
                <p class="section-subtitle"><?= t('dns_guide.section_subtitle') ?></p>
            </div>

            <div class="dns-grid">
                <article class="dns-card">
                    <div class="dns-card-header">
                        <div class="dns-card-badge"><?= t('dns_guide.card1.badge') ?></div>
                        <h3 class="dns-card-title"><?= t('dns_guide.card1.title') ?></h3>
                    </div>
                    <p class="dns-card-body">
                        <?= t('dns_guide.card1.body') ?>
                    </p>
                </article>

                <article class="dns-card">
                    <div class="dns-card-header">
                        <div class="dns-card-badge"><?= t('dns_guide.card2.badge') ?></div>
                        <h3 class="dns-card-title"><?= t('dns_guide.card2.title') ?></h3>
                    </div>
                    <p class="dns-card-body">
                        <?= t('dns_guide.card2.body') ?>
                    </p>
                </article>

                <article class="dns-card">
                    <div class="dns-card-header">
                        <div class="dns-card-badge"><?= t('dns_guide.card3.badge') ?></div>
                        <h3 class="dns-card-title"><?= t('dns_guide.card3.title') ?></h3>
                    </div>
                    <p class="dns-card-body">
                        <?= t('dns_guide.card3.body') ?>
                    </p>
                </article>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section" id="faq">
        <div class="container">
            <div class="section-header">
                <span class="section-tag"><?= t('faq.section_tag') ?></span>
                <h2 class="section-title"><?= t('faq.section_title') ?></h2>
                <p class="section-subtitle"><?= t('faq.section_subtitle') ?></p>
            </div>

            <div class="faq-list">
                <?php foreach (t('faq.items') as $index => $faq): ?>
                    <div class="faq-item">
                        <button type="button" class="faq-header" aria-expanded="false" aria-controls="faq-<?= $index + 1 ?>">
                            <span><?= htmlspecialchars($faq['q'], ENT_QUOTES, 'UTF-8') ?></span>
                            <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div class="faq-body" id="faq-<?= $index + 1 ?>">
                            <div class="faq-content">
                                <?= htmlspecialchars($faq['a'], ENT_QUOTES, 'UTF-8') ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="final-cta-section">
        <div class="container">
            <div class="final-cta-box">
                <h2 class="final-cta-title"><?= t('final_cta.title') ?></h2>
                <p class="final-cta-desc">
                    <?= t('final_cta.desc') ?>
                </p>
                <a href="<?= localeUrl($currentLocale, '/download') ?>" class="btn btn-primary btn-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    <span><?= t('final_cta.btn_text') ?></span>
                </a>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>