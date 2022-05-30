<!doctype html>
<html lang="en">
    <head>     
        <title>Garçon App</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
        <link href="img/favicon.png" rel="shortcut icon">
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset( 'assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset( 'assets/vendor/icomoon/css/iconfont.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/dmenu/css/menu.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/hamburgers/css/hamburgers.min.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/mmenu/css/mmenu.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/magnific-popup/css/magnific-popup.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/float-labels/css/float-labels.min.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/css/style.css') }}" rel='stylesheet'>

    </head>

    <body>           

        <!-- Preloader -->
        <div id="preloader">
            <div data-loader="circle-side"></div>
        </div>

        
        <!-- Main App -->     
        <div id="app">
            @include('components.public-navbar')
            @yield('content')
        </div>


        <!-- Back to top -->
        <div id="toTop">
            <i class="icon icon-chevron-up"></i>
        </div>


        <!-- About app -->
        @include('components.about-modal')


        <script src="{{ asset('js/app.js') }}"></script>
        
    </body>
      
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/parsley/js/parsley.min.js"></script>
	<script src="assets/vendor/nice-select/js/jquery.nice-select.min.js"></script>
	<script src="assets/vendor/theia-sticky-sidebar/js/ResizeSensor.min.js"></script>
	<script src="assets/vendor/theia-sticky-sidebar/js/theia-sticky-sidebar.min.js"></script>
	<script src="assets/vendor/mmenu/js/mmenu.min.js"></script>
	<script src="assets/vendor/magnific-popup/js/jquery.magnific-popup.min.js"></script>
	<script src="assets/vendor/scrollreveal/js/scrollreveal.min.js"></script>
	<script src="assets/vendor/lazyload/js/lazyload.min.js"></script>
	<script src="assets/vendor/sticky-kit/js/sticky-kit.min.js"></script>
	<script src="assets/js/utility.js"></script>

</html>


