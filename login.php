<?php 
    session_start();
    include_once './authHeader.php'
?>

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div style="background-image: url(./assets/img/gallery/gallery-1.jpg);" class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="./controller/LoginUser.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input name= "email" type="text" class="form-control form-control-user <?= isset($_SESSION['errors']['email'])? "is-invalid" : NULL ?>" id="exampleInputEmail" aria
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                            <span class= "text-danger">
                                                <?= $_SESSION['errors']['email'] ?? " " ?>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control form-control-user <?= isset($_SESSION['errors']['password'])? "is-invalid" : NULL ?>"
                                                id="exampleInputPassword" placeholder="Password">
                                            <span class= "text-danger"> 
                                                <?= $_SESSION['errors']['password'] ?? " " ?>
                                            </span>
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="./register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="./dashboard/vendor/jquery/jquery.min.js"></script>
    <script src="./dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./dashboard/js/sb-admin-2.min.js"></script>

</body>

</html>

<?php
session_unset();
?>