<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Lara4">
    <meta name="theme-color" content="#ffffff">

    <!-- Language Detection -->
    <link rel="alternate" hreflang="x-default" href="https://lara4.com" />
    <link rel="alternate" hreflang="en" href="https://lara4.com/en" />
    <link rel="alternate" hreflang="fr" href="https://lara4.com/fr" />
    <link rel="alternate" hreflang="es" href="https://lara4.com/es" />

    <title inertia>{{ config('app.name', 'Lara4') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />

    @include('feed::links')

        <!-- JSON-LD structured data -->
    <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "WebApplication",
                "name": "Lara4",
                "description": {
                    "@language": "en",
                    "@value": "Production-ready Laravel starter kit with Vue 3, Inertia.js, Tailwind CSS, and Filament admin"
                },
                "inLanguage": ["en", "fr", "es"],
                "applicationCategory": "DevelopmentTool",
                "operatingSystem": "Web",
                "offers": {
                    "@type": "Offer",
                    "price": "0",
                    "priceCurrency": "USD"
                }
            }
    </script>

    <!-- Scripts -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YNCZT23ZR9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-YNCZT23ZR9');
    </script>
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
