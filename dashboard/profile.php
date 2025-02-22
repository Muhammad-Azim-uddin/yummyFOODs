<?php
// session_start();
include '../include/backendHeader.php';
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
$fullName = $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name'];
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">profile page</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card rounded-0 shadow">
            <div class="card-header">
                profile info
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data"  action="../controller/updateProfile.php" method="POST">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="profile_img_input"> <img class="profile_img img-fluid" src="<?= getInfo($fullName)?>" style="border-radius:50%;object-fit:cover; object-position:center; height:200px; width:200px; " alt=""></label>
                            <input type="file" class="d-none " name="profile_image" id="profile_img_input">
                            <span class="text-danger">
                                <?= $_SESSION['errors']['profile_image']?? ''?>
                            </span>
                        </div>
                        <div class="col-lg-8">

                            <input type="text" class="form-control my-3" name="first_name" id="first_name" placeholder="first-name" value="<?= $_SESSION['user']['first_name'] ?? '' ?>">
                            <input type="text" class="form-control my-3" name="last_name" id="last_name" placeholder="last-name" value="<?= $_SESSION['user']['last_name'] ?? ' ' ?>">
                            <input type="text" class="form-control my-3" name="email" id="email" placeholder="email"
                                value="<?= $_SESSION['user']['email'] ?? '' ?>">
                            <button type="submit" class="btn btn-primary btn-sm">Update Profile</button>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card rounded-0 shadow">
            <div class="card-header">
                Reset Password
            </div>
            <div class="card-body">
                <form action="../controller/passwordController.php" method="POST">
                    <input type="password" class="form-control mt-3" name="old_password" placeholder="old password">
                    <span class="text-danger mb-3">
                        <?= $_SESSION['errors']['old_password'] ?? NULL ?>
                    </span>
                    <input type="password" class="form-control mt-3 mb-1" name="new_password" placeholder="new password">
                    <span class="text-danger mb-3">
                        <?= $_SESSION['errors']['new_password'] ?? NULL ?>
                    </span>
                    <input type="password" class="form-control mt-3 mb-2" name="confirm_password" placeholder="confirm password">
                    <span class="text-danger mb-2">
                        <?= $_SESSION['errors']['confirm_password'] ?? NULL ?>
                    </span>
                    <button type="submit" class="btn btn-primary btn-sm">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include '../include/backendFooter.php';
if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
?>


<script
    src="https://code.jquery.com/jquery-3.7.0.min.js">
</script>
<script>
    $(document).ready(function() {
        $("#profile_img_input").change(function() {
            let file = $(this)[0].files[0];
            let url = URL.createObjectURL(file);
            $(".profile_img").attr("src", url);
        })
    })
</script>