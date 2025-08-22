<?php $this->load->view('includes/header.php');  ?>

    <body class="authentication">

        <!-- Container start -->
        <div class="container">

            <form action="index.html">
                <div class="row justify-content-md-center">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                        <div class="login-screen">
                            <div class="login-box">
                                <a href="#" class="login-logo justify-content-center mb-3">
                                    <img src="<?php echo base_url() ?>assets/img/DOLE LOGO.png" alt="Admin Templates & Dashboards" />
                                </a>
                                <div class="text-center">
                                    <h3>TUPAD EVALUATION SYSTEM</h3>
                                    <h5>Welcome back,<br />Please Login to your account.</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email Address" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" />
                                </div>
                                <div class="actions mb-4">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <!-- Container end -->

    </body>

</html>