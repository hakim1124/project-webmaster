<!-- Header -->
<header id="header">
    <!-- Header Top Bar -->
    <div class="top-bar">
        <div class="slidedown collapse">
            <div class="container">
                <div class="pull-left">
                    <!-- <ul class="social pull-left">
                        <li class=""><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="dribbble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li class="rss"><a href="#"><i class="fa fa-rss"></i></a></li>
                    </ul> -->
                </div>
                <div class="phone-login pull-right">
                    <!-- Currency Selector -->
                    <!-- <div class="btn-group currency btn-select">
                        <a href="#" data-toggle="dropdown" role="button" class="dropdown-toggle">
                            <span class="hidden-xs"><img src="http://localhost/WebMaster/assets/img/shop/currency.png" alt=""></span><span class="visible-xs"><img src="http://localhost/WebMaster/assets/img/shop/currency.png" alt=""></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><img alt="" src="http://localhost/WebMaster/assets/img/shop/flags/USA.png"> USD</a></li>
                            <li><a href="#"><img alt="" src="http://localhost/WebMaster/assets/img/shop/flags/France.png"> EURO</a></li>
                            <li><a href="#"><img alt="" src="http://localhost/WebMaster/assets/img/shop/flags/Bangladesh.png"> BDT</a></li>
                        </ul>
                    </div> -->
                    <!-- /Currency Selector -->
                    <!-- Language Selector -->
                    <!-- <div class="btn-group language btn-select">
                        <a href="#" data-toggle="dropdown" role="button" class="dropdown-toggle">
                            <span class="hidden-xs"><img src="img/shop/flags/USA.png" alt=""></span><span class="visible-xs"><img src="img/shop/flags/USA.png" alt=""></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><img alt="" src="http://localhost/WebMaster/assets/img/shop/flags/USA.png"> English</a></li>
                            <li><a href="#"><img alt="" src="http://localhost/WebMaster/assets/img/shop/flags/France.png"> France</a></li>
                            <li><a href="#"><img alt="" src="http://localhost/WebMaster/assets/img/shop/flags/Germany.png"> Germany</a></li>
                        </ul>
                    </div> -->
                    <!-- /Language Selector -->
                    <a href="/users/password"><i class="fa fa-user"></i> Password</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Header Top Bar -->
    <!-- Main Section -->
    <section id="main">
        <div class="breadcrumb-wrapper">
            <div class="pattern-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                            <h2 class="title">Password</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                            <div class="breadcrumbs pull-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="content margin-top60 margin-bottom60">
            <div class="container">
                <?php if (isset($model['error'])) { ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            <?= $model['error'] ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <!-- Contact Form -->
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="contact-form">
                        <h2>Update Password</h2>
                        <form method="post" action="/users/password">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="id">Id</label>
                                    <input type="text" class="form-control" id="id" placeholder="id" disabled value="<?= $model['user']['id'] ?? '' ?>">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="name">oldPassword</label>
                                    <input class="form-control" type="password" id="oldPassword" name="oldPassword" placeholder="oldPassword" value="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="name">newPassword</label>
                                    <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="newPassword" value="">
                                </div>
                            </div>
                            <button class="btn btn-color submit pull-right" type="submit">Update Password</button>
                        </form>
                    </div>
                </div>
                <!-- Star -->
                <div class="star">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="star-divider">
                                <div class="star-divider-icon">
                                    <i class=" fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Star -->
                <!-- Google Map -->
                <div class="row">
                </div>
                <!-- /Google Map -->
            </div>
        </div>
        <!-- /Main Content -->