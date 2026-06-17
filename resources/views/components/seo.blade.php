<title>{{ $title }}</title>
@if ($favicon)
    <link rel="shortcut icon" href="{{ $favicon }}">
@else
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
@endif
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $url }}">

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:type" content="website">

@if ($image)
    <meta property="og:image" content="{{ $image }}">
    <meta name="twitter:image" content="{{ $image }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">