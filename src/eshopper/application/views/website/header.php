<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="<?= base_url("assets/website/") ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url("assets/website/") ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url("assets/website/") ?>css/prettyPhoto.css" rel="stylesheet">
    <link href="<?= base_url("assets/website/") ?>css/price-range.css" rel="stylesheet">
    <link href="<?= base_url("assets/website/") ?>css/animate.css" rel="stylesheet">
    <link href="<?= base_url("assets/website/") ?>css/main.css" rel="stylesheet">
    <link href="<?= base_url("assets/website/") ?>css/responsive.css" rel="stylesheet">
    <link href="<?= base_url("assets/website/") ?>css/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url("assets/website/") ?>css/owl.theme.default.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url("assets/website/") ?>images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url("assets/website/") ?>images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url("assets/website/") ?>images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url("assets/website/") ?>images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= base_url("assets/website/") ?>images/ico/apple-touch-icon-57-precomposed.png">
    <script src="<?= base_url("assets/website/") ?>js/jquery.js"></script>
    <script src="<?= base_url("assets/website/") ?>js/owl.carousel.min.js"></script>
    <script src="<?= base_url("assets/website/") ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url("assets/website/") ?>js/jquery.scrollUp.min.js"></script>
    <script src="<?= base_url("assets/website/") ?>js/price-range.js"></script>
    <script src="<?= base_url("assets/website/") ?>js/jquery.prettyPhoto.js"></script>
    <script src="<?= base_url("assets/website/") ?>js/main.js"></script>
    <script src="<?= base_url("assets/website/") ?>js/html5shiv.js"></script>
    <script src="<?= base_url("assets/website/") ?>js/respond.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head><!--/head-->
<body>
<header id="header"><!--header-->
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="<?= base_url("main") ?>"><img src="<?= base_url("assets/website/") ?>images/home/logo.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="<?= base_url("main/urunekle") ?>"><i class="fa fa-crosshairs"></i>Ürün Ekle</a></li>
                            <li><a href="<?= base_url("main/sepet") ?>"><i class="fa fa-shopping-cart"></i> Sepet</a></li>
                            <li><a href="<?= base_url("main/favori") ?>"><i class="fa fa-heart"></i> Favoriler</a></li>
                            <?php if (!empty($this->session->userdata["kullaniciBilgi"])){
                                echo "<li><a><i class='fa fa-user'></i>".$this->session->userdata["kullaniciBilgi"]["kadi"]."</a></li>";
                                echo "<li><a href=".base_url('kullanici/logout')."><i class='fa fa-lock'></i> Çıkış</a></li>";
                             }else{
                                echo "<li><a href=".base_url('kullanici/login')."><i class='fa fa-lock'></i> Login</a></li>";
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="<?= base_url("main") ?>" class="active">Home</a></li>
                            <li class="dropdown"><a href="#">Mağaza<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="<?= base_url("main/product") ?>">Ürünler</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->