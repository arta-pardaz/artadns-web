# ArtaDNS Web - PHP 8.4

ساختار مجدد وب‌سایت ArtaDNS با PHP 8.4.27

## ساختار پروژه

```
artadns-web/
├── config/
│   └── menu.php          # تنظیمات منوی گلوبال
├── includes/
│   ├── header.php        # هدر سایت (با متادیتا و اسکیم‌ها)
│   ├── nav.php           # نوار ناوبری (از config/menu.php می‌خواند)
│   └── footer.php        # فوتر سایت
├── index.php             # صفحه اصلی
├── download.php          # صفحه دانلود
├── dns-gaming.php        # صفحه DNS Gaming
├── css/
│   └── style.css         # استایل‌ها
├── js/
│   └── main.js           # جاوااسکریپت
├── images/               # تصاویر
├── fonts/                # فونت‌ها
├── composer.json         # تنظیمات Composer
└── .htaccess             # بازنویسی URL
```

## ویژگی‌ها

- **PHP 8.4.27** - استفاده از آخرین نسخه PHP
- **منوی گلوبال** - منو در `config/menu.php` تعریف شده و در همه صفحات استفاده می‌شود
- **کامپوننت‌های قابل tái استفاده** - header، nav، footer در پوشه `includes/`
- **SEO-friendly** - متادیتا، Open Graph، Twitter Card، Schema.org markup
- **Responsive** - موبایل-فrsat
- **RTL Support** - پشتیبانی کامل از فارسی

## نصب و اجرا

```bash
# نصب وابستگی‌های توسعه
composer install

# اجرای سرور توسعه
composer serve
# یا
php -S localhost:8000 -t .
```

سپس در مرورگر به `http://localhost:8000` بروید.

## منوی گلوبال

منو در `config/menu.php` تعریف شده:

```php
return [
    'items' => [
        ['label' => 'صفحه اصلی', 'href' => 'index.php', 'fragment' => null, 'active' => ['index']],
        ['label' => 'ویژگی‌ها', 'href' => 'index.php', 'fragment' => 'features', 'active' => ['index']],
        // ...
    ],
    'cta' => [
        'label' => 'دانلود ArtaDNS',
        'href' => 'download.php',
        'class' => 'btn btn-primary btn-sm',
    ],
];
```

## دستورات توسعه

```bash
# بررسی کد (Lint)
composer lint

# اصلاح خودکار کد
composer lint:fix

# تحلیل استاتیک
composer analyze
```