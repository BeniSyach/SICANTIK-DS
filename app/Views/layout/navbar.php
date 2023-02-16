<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?= base_url('assets/img/logo/LogoDeliSerdang2.png') ?>" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top top-bg d-none d-lg-block">
                    <div class="container">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-lg-8">
                                <div class="header-info-left">
                                    <ul>
                                        <li class="text-center">Surat Keluar</li>
                                        <li>Dinas Kominfostan Kabupaten Deli Serdang</li>
                                        <li>Jl. P. Diponegoro No.78, Kec. Lubuk Pakam, Kabupaten Deli Serdang, Sumatera Utara 20518</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="header-info-right f-right">
                                    <ul class="header-social">
                                        <li><a target="blank" href="#"><i class="fas fa-globe"></i></a></li>
                                        <li><a target="blank" href="#"><i class="fab fa-youtube"></i></a></li>
                                        <li><a target="blank" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom  header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2 col-md-1">
                                <div class="logo my-1">
                                <a href="/"><img src="<?= base_url('assets/img/SICANTIK.png') ?>" alt="" width="20%">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-md-10">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>               
                                        <ul id="navigation"> 
                                        <?php $session = session(); ?>
                                    <?php if (!$session->get('username')) : ?>
                                            <li><a href="#" class="tombolLogin">Login</a></li>
                                            <?php else : ?>
                                                <li><a  href="<?= site_url('auth/logout') ?>" class="tombolLogout">Logout</a></li>
                                                <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none">              
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>