<?php
include '../include/backendHeader.php';
include '../database/env.php';

$query = "SELECT * FROM banner";
$result = mysqli_query($conn, $query);
$banner = '';
if ($result->num_rows > 0) {
    $banner = mysqli_fetch_assoc($result);
}

?>

<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header">Banner info</div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="../controller/bannerController.php" method="POST">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value = <?= $banner['title']?? NULL ?>>
                        <span class="text-danger">
                            <?= $_SESSION['errors']['title']?? '' ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" id="description" name="description" value="<?= $banner['description']?? NULL ?>"></input>
                        <span class="text-danger">
                            <?= $_SESSION['errors']['description']?? '' ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="image"> Banner img <span class="text-danger"><sup>*</sup></span></label>
                        <img class="d-block mb-2 " style="max-width: 150px;" src="../uploads/banner/<?= $banner['image']?? null ?>"   >
                        <input type="file" class="form-control-file" id="image" name="image">
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
