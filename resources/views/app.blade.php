<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta charset="UTF-8">
        <script src="/JavaScript/material.min.js"></script>
        <link rel="stylesheet" href="/css/HeaderStyle.css" />
        <link rel="stylesheet" href="/css/material.min.css">
        <link rel="stylesheet" href="/css/iconfont.css">
        <link rel="apple-touch-icon" sizes="57x57" href="/Assets/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/Assets/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/Assets/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/Assets/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/Assets/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/Assets/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/Assets/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/Assets/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/Assets/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="/Assets/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/Assets/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="/Assets/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/Assets/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/Assets/manifest.json">
        <link rel="mask-icon" href="/Assets/safari-pinned-tab.svg" color="#c71585">
        <link rel="shortcut icon" href="/Assets/favicon.ico">
        <meta name="apple-mobile-web-app-title" content="OneEchan">
        <meta name="application-name" content="OneEchan">
        <meta name="msapplication-TileColor" content="#c71585">
        <meta name="msapplication-TileImage" content="/Assets/mstile-144x144.png">
        <meta name="msapplication-config" content="/Assets/browserconfig.xml">
        <meta name="theme-color" content="#c71585">
        <title>{{isset($title)?$title:'OneEchan'}}</title>
        @yield('head')
    </head>
    <body>
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row Header">
                    @if((isset($canBack) && $canBack) || !isset($canBack))
                    <button style="margin: 0 20 0 -12;" onclick="history.back();" class="mdl-button mdl-js-button mdl-button--icon">
                        <i class="material-icons">arrow_back</i>
                    </button>
                    @endif
                    <button class="mdl-button" onclick="location.href='/'">
                        <span class="mdl-layout-title Header-Text">{{isset($title)?$title:'OneEchan'}}</span>
                    </button>
                    @yield('header')
                </div>
            </header>
            <main class="mdl-layout__content">
                @yield('content')
            </main>
        </div>
        @yield('footer')
    </body>
</html>