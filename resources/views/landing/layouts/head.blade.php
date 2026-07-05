<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Title -->
  <title>@yield('title', $seo->meta_title ?? 'Default Title')</title>

  <!-- Basic Meta Tags -->
  <meta name="description" content="@yield('meta_description', $seo->meta_description ?? '')">
  <meta name="keywords" content="@yield('meta_keywords', $seo->keyword ?? '')">

  @if(!empty($seo->author))
  <meta name="author" content="{{ $seo->author }}">
  @endif

  <!-- Canonical URL -->
  <link rel="canonical" href="@yield('canonical', $seo->canonical_url ?? url()->current())">

  <!-- Robots Meta -->
  <meta name="robots" content="{{ $seo->robots ?? 'index,follow' }}">

  <!-- Open Graph -->
  <meta property="og:type" content="@yield('og_type', $seo->og_type ?? 'website')">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="@yield('og_title', $seo->meta_title ?? '')">
  <meta property="og:description" content="@yield('og_description', $seo->meta_description ?? '')">
  <meta property="og:locale" content="ar_EG">

  @if(!empty($seo->og_site_name))
  <meta property="og:site_name" content="{{ $seo->og_site_name }}">
  @endif

  @if(!empty($seo->og_image))
  <meta property="og:image" content="{{ asset('storage/' . $seo->og_image) }}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  @endif

  <!-- Twitter -->
  <meta name="twitter:card" content="{{ $seo->twitter_card_type ?? 'summary_large_image' }}">
  <meta name="twitter:url" content="{{ url()->current() }}">
  <meta name="twitter:title" content="@yield('twitter_title', $seo->meta_title ?? '')">
  <meta name="twitter:description" content="@yield('twitter_description', $seo->meta_description ?? '')">

  @if(!empty($seo->twitter_handle))
  <meta name="twitter:site" content="{{ $seo->twitter_handle }}">
  <meta name="twitter:creator" content="{{ $seo->twitter_handle }}">
  @endif

  @if(!empty($seo->og_image))
  <meta name="twitter:image" content="{{ asset('storage/' . $seo->og_image) }}">
  @endif

  <!-- Custom Header Scripts -->
  {!! $seo->header_code ?? '' !!}

  <!-- ================= Schema.org ================= -->

  <!-- Organization -->
  <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'HVACBusiness',
        'name' => 'ماس للتبريد والتكييف المركزي | Mas Cooling',
        'alternateName' => 'Mas Cooling',
        'url' => url('/'),
        'logo' => asset('land/images/logo-light-opt.png'),
        'image' => asset('land/images/logo-light-opt.png'),
        'description' => 'شركة ماس للتبريد والتكييف المركزي متخصصة في تصميم وتركيب وصيانة غرف التبريد وغرف التجميد وأنظمة التكييف المركزي الصناعي والتجاري. خبرة أكثر من 15 عاماً.',
        'telephone' => optional(\App\Models\Setting\ContactSetting::first())->phone,
        'email' => optional(\App\Models\Setting\ContactSetting::first())->email ?? 'info@mas-cooling.com',
        'priceRange' => '$$',
        'currenciesAccepted' => 'EGP',
        'paymentAccepted' => 'Cash, Bank Transfer',
        'openingHours' => 'Mo-Sa 08:00-18:00',
        'areaServed' => [
            ['@type' => 'Country', 'name' => 'Egypt'],
            ['@type' => 'Country', 'name' => 'مصر'],
        ],
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => 'خدمات التبريد والتكييف',
            'itemListElement' => [
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'تصميم وتركيب غرف التبريد']],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'تصميم وتركيب غرف التجميد']],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'أنظمة التكييف المركزي']],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'صيانة أنظمة التبريد']],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'صيانة التكييف المركزي']],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'استشارات كفاءة الطاقة']],
            ],
        ],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'telephone' => optional(\App\Models\Setting\ContactSetting::first())->phone,
            'contactType' => 'customer service',
            'areaServed' => 'EG',
            'availableLanguage' => ['Arabic', 'English']
        ],
        'sameAs' => array_filter([
            optional(\App\Models\Setting\ContactSetting::first())->linkedin,
            optional(\App\Models\Setting\ContactSetting::first())->facebook,
            optional(\App\Models\Setting\ContactSetting::first())->twitter,
            optional(\App\Models\Setting\ContactSetting::first())->instagram,
        ]),
        'knowsAbout' => ['تبريد', 'غرف تبريد', 'غرف تجميد', 'تكييف مركزي', 'تبريد صناعي', 'تبريد تجاري', 'صيانة تكييف', 'Cooling', 'Refrigeration', 'HVAC', 'Cold Rooms', 'الماس لغرف التبريد', 'الماس للتبريد', 'الماس للغرف', 'تكييفات', 'mas لغرف التبريد', 'mas للتكييف'],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
  </script>

  <!-- WebSite -->
  <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => $seo->og_site_name ?? ($seo->meta_title ?? config('app.name')),
        'url' => url('/'),
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => url('/') . '?q={search_term_string}'
            ],
            'query-input' => 'required name=search_term_string'
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
  </script>

  <!-- Breadcrumbs -->
  @php
  $breadcrumbs = [
      ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
  ];

  if ($seg1 = request()->segment(1)) {
      $breadcrumbs[] = [
          '@type' => 'ListItem',
          'position' => 2,
          'name' => ucfirst($seg1),
          'item' => url($seg1)
      ];
  }

  if ($seg2 = request()->segment(2)) {
      $breadcrumbs[] = [
          '@type' => 'ListItem',
          'position' => 3,
          'name' => ucfirst($seg2),
          'item' => url($seg1 . '/' . $seg2)
      ];
  }
  @endphp

  @if(count($breadcrumbs) > 1)
  <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $breadcrumbs
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
  </script>
  @endif

  <!-- Favicon -->
  @if(!empty($seo->favicon))
  <link rel="icon" href="{{ asset('storage/' . $seo->favicon) }}">
  @else
  <link rel="icon" type="image/png" href="{{ secure_asset('land/images/favicon.png') }}">
  @endif

  <!-- ============ PRIORITY 1: Hero Image (LCP Element) ============ -->
  @if(isset($heroSection->image))
  @php
    $baseImage = str_replace(['.jpg', '.png', '.jpeg'], '', $heroSection->image);
    $webpImage = $baseImage . '.webp';
    $mobileWebp = $baseImage . '-mobile.webp';
  @endphp
  <link rel="preload" as="image" href="{{ secure_asset('storage/' . $webpImage) }}"
    imagesrcset="{{ secure_asset('storage/' . $mobileWebp) }} 600w, {{ secure_asset('storage/' . $webpImage) }} 1200w"
    imagesizes="(max-width: 767px) 100vw, 1200px"
    fetchpriority="high"
    media="(min-width: 768px)">
  @endif

  <style>
    /* Minimal critical CSS for above-the-fold rendering */
    body{margin:0;font-family:ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;font-size:16px;line-height:26px;position:relative;z-index:1;color:#79808a}
    h1,h2,h3,h4,h5,h6{font-family:Outfit,"Segoe UI",sans-serif;font-size:inherit;font-weight:inherit}
    *,::before,::after{box-sizing:border-box;border-width:0;border-style:solid;border-color:currentColor}
    img,svg,video{display:block;vertical-align:middle;max-width:100%;height:auto}
    a{color:inherit;text-decoration:inherit}
    ul,ol,menu{list-style:none;margin:0;padding:0}
    button{cursor:pointer}
    [x-cloak]{display:none!important}
    .b{--tw-bg-opacity:1;background-color:rgb(18 24 38/var(--tw-bg-opacity))}
    .eh{color-scheme:dark}
    /* Header critical styles to prevent FOUC */
    .shiraa-header-wrapper{position:fixed;top:0;left:0;width:100%;z-index:1000;direction:rtl;font-family:'Inter','Segoe UI',sans-serif}
    .shiraa-topbar{background:#075985;color:#fff;padding:0 5%;font-size:.85rem;display:flex;justify-content:space-between;align-items:center;height:40px}
    .shiraa-navbar{background:#fff;box-shadow:0 2px 15px rgba(0,0,0,.05);height:85px}
    .eh .shiraa-navbar{background:#0f172a;box-shadow:0 2px 15px rgba(0,0,0,.5)}
    .shiraa-navbar__inner{display:flex;justify-content:space-between;align-items:center;height:100%;padding:0 5%;max-width:1400px;margin:0 auto}
    .shiraa-logo img{height:70px;object-fit:contain}
    .shiraa-nav ul{display:flex;align-items:center;gap:2rem}
    .shiraa-nav a{color:#1e293b;font-weight:700;font-size:.95rem;text-decoration:none}
    .eh .shiraa-nav a{color:#f1f5f9}
    .shiraa-actions{display:flex;gap:.75rem;align-items:center}
    .shiraa-icon-btn{width:42px;height:42px;border-radius:50%;background:#fff;border:1px solid #e2e8f0;display:flex;align-items:center;justify-content:center;color:#475569;text-decoration:none;padding:0}
    .eh .shiraa-icon-btn{background:#1e293b;border-color:#334155;color:#94a3b8}
    .shiraa-mobile-toggle{display:none}
    @media(max-width:992px){.shiraa-topbar{display:none}.shiraa-nav,.shiraa-actions{display:none}.shiraa-mobile-toggle{display:block}}
  </style>

  <!-- ============ PRIORITY 3: Main CSS (NON-render-blocking) ============ -->
  <link rel="preload" href="{{ secure_asset('land/style.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link href="{{ secure_asset('land/style.css') }}" rel="stylesheet"></noscript>

  <!-- ============ PRIORITY 4: DNS hints (low priority) ============ -->
  <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
  <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

  <!-- ============ PRIORITY 5: Google Fonts (non-blocking) ============ -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Outfit:wght@700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">

  <!-- ============ PRIORITY 6: FontAwesome (deferred to after load) ============ -->
  <script>
    window.addEventListener('load', function() {
      setTimeout(function() {
        var fa = document.createElement('link');
        fa.rel = 'stylesheet';
        fa.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css';
        document.head.appendChild(fa);
      }, 50);
    });
  </script>

  <!-- Extra Head Scripts -->
  @stack('head_scripts')
</head>

<body
  x-data='{ page: @json($page ?? "home"), stickyMenu: false, navigationOpen: false, scrollTop: false }'>
