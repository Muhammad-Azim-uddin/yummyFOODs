<?php
// session_start();
include '../include/backendHeader.php';
include '../database/env.php';
$_SESSION['banner'] = $_REQUEST;
$query = "SELECT * FROM banner WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$banner = mysqli_fetch_assoc($result);
?>

<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header">Banner info</div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="../controller/bannerController.php" method="POST">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value = >
                        <span class="text-danger">
                            <?= $_SESSION['errors']['title']?? '' ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" id="description" name="description" ></input>
                        <span class="text-danger">
                            <?= $_SESSION['errors']['description']?? '' ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="image"> <img  src="<?= "../uploads/banner/" . $banner["image"] ?? '' ?> "  class="banner_image img-fluid rounded-circle" style="width:150px; height:150px;object-fit:cover;object-position:center" > </label>
                        <input type="file" class="form-control-file" id="image" name="image"  >
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>




<?php
include '../include/backendFooter.php';
unset($_SESSION['errors']);
?>
