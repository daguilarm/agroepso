<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name') }}</title>
<meta name="description" content="{{ config('app.description') }}">
<meta name="robots" content="noodp"/>
<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
<link rel="canonical" href="{{ config('author.http') }}" />
<meta name="author" content="{{ config('author.name') }}, {{ config('author.email') }}">
<meta name='author' content='{{ config('author.url') }}'>
<meta name='owner' content='{{ config('app.name') }}'>
<meta name='url' content='{{ config('author.http') }}'>
<meta name='identifier-URL' content='{{ config('author.http') }}'>
<meta name='directory' content='submission'>
<meta name='coverage' content='Worldwide'>
<meta name='distribution' content='Global'>
<meta name='rating' content='General'>
<meta name='revisit-after' content='7 days'>
<meta name='target' content='all'>
<meta name='HandheldFriendly' content='True'>
<meta name='MobileOptimized' content='320'>
<meta name='pageKey' content='guest-home'>
<meta itemprop='name' content='jQTouch'>
<meta http-equiv='Expires' content='0'>
<meta http-equiv='Pragma' content='no-cache'>
<meta http-equiv='Cache-Control' content='no-cache'>
<meta http-equiv='imagetoolbar' content='no'>
<meta http-equiv='x-dns-prefetch-control' content='off'>
<!-- Twitter meta-->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:site" content="{{ config('author.twitter') }}">
<meta property="twitter:creator" content="{{ config('author.twitter') }}">
<!-- Open Graph Meta-->
<meta property="og:locale" content="{{ app()->getLocale() }}" />
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:title" content="{{ config('app.name') }} by {{ config('author.name') }}">
<meta property="og:url" content="{{ config('author.http') }}">
<meta property="og:image" content="{{ config('author.img') }}">
<meta property="og:description" content="{{ config('app.description') }}">
<!-- Google -->
<meta name="google-site-verification" content="" />
<!-- Maps configuration -->
@yield('leaflet')
<!-- Font awesome configuration -->
<script>
  FontAwesomeConfig = { autoAddCss: false }
</script>
