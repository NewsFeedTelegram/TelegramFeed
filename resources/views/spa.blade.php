<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>Beautifullife</title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="path/to/image.jpg">
    <link rel="icon" href="img/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon-180x180.png">
    <meta name="theme-color" content="#4a4c63">

    <!-- Fonts -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">
    <div class="holder">
        <div class="preloader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    <app-index></app-index>
</div>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    var hideLoader = function () {
        let el = document.querySelector( '.holder' );
        el.style.display = 'none';
        return;
    }

    if ( window.localStorage[ 'access-token' ]
        || !window.localStorage[ 'access-token' ] && window.location.pathname !== '/'  ) {
        hideLoader()
    }
</script>
</body>
</html>
