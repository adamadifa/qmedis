<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-alpha.14
* @link https://tabler.io
* Copyright 2018-2020 The Tabler Authors
* Copyright 2018-2020 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/assets/assets/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <!-- CSS files -->
    @include('layouts.style')
</head>

<body class="antialiased">
    <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="." class="navbar-brand navbar-brand-autodark">
                <img src="{{asset('qmedis/css/logo2.png')}}" alt="Tabler" class="navbar-brand-image">
            </a>
            @include('layouts.header')
            @include('layouts.navbar')
        </div>
    </aside>
    <div class="page">
        @include('layouts.headertop')
        <div class="content">
            <div class="container-fluid">

                @include('layouts.content')

            </div>
            @include('layouts.footer')
        </div>
    </div>
    @include('layouts.script')
</body>

</html>
