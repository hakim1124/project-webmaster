<!-- Main Section -->
<section id="main">
    <!-- Title, Breadcrumb -->
    <div class="breadcrumb-wrapper">
        <div class="pattern-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                        <h2 class="title">Login</h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                        <div class="breadcrumbs pull-right">
                            <ul>
                                <li>Kembali ke halaman :</li>
                                <li><a href="/">Home</a></li>
                                <!-- <li><a href="#">Pages</a></li> -->
                                <!-- <li>Login / Register Page</li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Title, Breadcrumb -->
    <!-- Main Content -->
    <div class="content margin-top60 margin-bottom60">
        <div class="container">
            <div class="row">
                <!-- Login -->
                <div class="featured-boxes login">
                    <!-- Login -->
                    <div class="col-md-6">
                        <div class="featured-box featured-box-secundary default info-content">
                            <?php if (isset($model['error'])) { ?>
                                <div class="row">
                                    <div class="alert alert-danger" role="alert">
                                        <?= $model['error'] ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <h2 class="form-signin-heading">Login</h2>
                            <div class="box-content ">
                                <form action="/users/login" id="siginin" method="post">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input name="id" type="text" value="<?= $_POST['id'] ?? '' ?>" class="form-control" placeholder="id">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input name="password" type="password" class="form-control" placeholder="Password">
                                                <a class="pull-right" href="">(Lost Password?)</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-md-9">
                                            <span class="remember-box checkbox">
                                                <label for="rememberme">
                                                    <input type="checkbox" id="rememberme" name="rememberme">Remember Me
                                                </label>
                                            </span>
                                        </div> -->
                                        <div class="col-md-3">
                                            <input type="submit" value="Login" class="btn btn-color push-bottom" data-loading-text="Loading...">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Login -->
                    <!-- Registration -->

                    <!-- /Registration -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Content -->
</section>
<!-- /Main Section -->