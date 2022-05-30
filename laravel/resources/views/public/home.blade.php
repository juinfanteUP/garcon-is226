
@extends('layout.public')
@section('content')


<!-- Hero -->
<div class="hero-home bg-mockup hero-bottom-border">
    <div class="content">

        <img src="assets/img/garcon-md.png" width="100" class="mb-3">
        <h1 class="animated-element m-0 mt-3">
            Welcome to Garçon
        </h1>
        <p class="animated-element m-0 small">
            Automated Menu Ordering System
        </p>
        <a href="#orderFood" class="mouse-frame nice-scroll">
            <div class="mouse"></div>
        </a>
    </div>
</div>
<!-- Hero End -->

<!-- Services -->
<div class="services mt-5 pt-4">
    <div class="container">
        
        <div class="row justify-content-center pt-4">
            <div class="col-lg-8 animated-element">
                <a href="/menu" class="service-link">
                    <div class="box text-center">
                        <div class="icon d-flex align-items-end">
                            <i class="icon icon-credit-card2"></i>
                        </div>
                        <h3 class="service-title mb-2">
                            Let's proceed for today's menu
                        </h3>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 animated-element">
                <a href="/admin-menu" class="service-link">
                    <div class="box text-center">
                        <div class="icon d-flex align-items-end">
                            <i class="icon icon-user"></i>
                        </div>
                        <h3 class="service-title mb-2">
                            Go to management portal
                        </h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->

<div class="text-center text-muted mt-5">
    Developed by Dave Infante | Project in IS226 - Web Information Systems
</div>


@endsection

