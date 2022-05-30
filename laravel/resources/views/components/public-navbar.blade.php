<header class="main-header sticky">
    <a href="#menu" class="btn-mobile">
        <div class="hamburger hamburger--spin" id="hamburger">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </a>
    <div class="container">
        <div class="row ">
            <div class="col-lg-3 col-6">
                <div id="logo">
                    <h3 class="m-0 pt-1">
                        <a href="/">
                            <img src="assets/img/garcon-md.png" class="pr-1" width="37"> Garçon
                        </a>
                    </h3>
                </div>
            </div>
            <div class="col-lg-9 col-6">
                <nav id="menu" class="main-menu">
                    <ul>
                        <li>
                            <span><a href="/">Home</a></span>
                        </li>
                        <li>
                            <span><a href="/menu">Menu</a></span>
                        </li>
                        <li>
                            <span><a href="/orders">My Order <span>(@{{ orderList.length }})</span></a></span>
                        </li>
                        <li>
                            <span><a href="#aboutAppModal" class="modal-opener">About</a></span>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>