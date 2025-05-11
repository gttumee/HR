
<head>
    <!-- OG Title -->
    <meta property="og:title" content="{{ $items->first()->name ?? 'デフォルトタイトル' }}" />

    <!-- OG Description -->
    <meta property="og:description" content="{{ $items->first()->type ?? 'デフォルト説明' }}" />

    <!-- OG Image -->
    <meta property="og:image" content="{{ $items->first()->avatar ?? 'デフォルト画像のURL' }}" />

    <!-- OG URL -->
    <meta property="og:url" content="{{ url()->current() }}" />

    <!-- OG Type -->
    <meta property="og:type" content="website" />
</head>
