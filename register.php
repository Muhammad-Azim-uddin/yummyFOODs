<?php 
    session_start();
    include_once './authHeader.php'
?>

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div style="background-image: url(./assets/img/gallery/gallery-2.jpg);" class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="./controller/RegisterUser.php" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="first_name" type="text" class="form-control form-control-user <?= isset($_SESSION['errors']['first_name'])? "is-invalid" : NULL ?>" id="exampleFirstName"
                                            placeholder="First Name">
                                            <span class= "text-danger">
                                                <?= $_SESSION['errors']['first_name']?? "" ?>
                                            </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="last_name"  class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email"  class="form-control form-control-user <?= isset($_SESSION['errors']['email'])? "is-invalid" : NULL ?>" id="exampleInputEmail"
                                        placeholder="Email Address">
                                        <span class= "text-danger">
                                                <?= $_SESSION['errors']['email']?? "" ?>
                                            </span>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password"  class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                            <span class= "text-danger">
                                                <?= $_SESSION['errors']['password']?? "" ?>
                                            </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="confirm_password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                            <span class= "text-danger">
                                                <?= $_SESSION['errors']['confirm_password']?? "" ?>
                                            </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="./login.php">Already have an account? Login!</a>
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
    <script src=" ./dashboard/js/sb-admin-2.min.js"></script>

</body>

</html>

<?php 
    session_unset();
?>
