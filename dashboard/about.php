<?php
// session_start();
include '../include/backendHeader.php';
include '../database/env.php';

// $query = "SELECT * FROM about";
// $result = mysqli_query($conn, $query);
// // print_r($result);
// // exit;
// if ($result->num_rows > 0) {
//     $about = mysqli_fetch_assoc($result);
//     print_r($about);
//     // exit;
// }

if (isset($_SESSION['about'])) {
    $about = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about"));
    // print_r($about);
}

?>


<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header">About info</div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="../controller/aboutController.php" method="POST">
                    <div class="form-group">
                        <label for="title">About Heading</label>
                        <input type="text" class="form-control" id="title" placeholder="Heading.." name="title" value="<?= $about['title'] ?? '' ?>">
                        <span class="text-danger">
                            <?= $_SESSION['errors']['title'] ?? '' ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label>About details</label>
                        <div class="row">
                            <div class="col-lg-6 ">
                                <!-- <label for="aboutImage">About Image :</label> -->
                                <img class=" " style="max-width: 150px;" src="<?= $about['aboutImage'] ?? '' ?>">
                                <input type="file" class="form-control-file" id="image" name="image">
                                <span><?= $_SESSION['errors']['aboutImage']?? '' ?></span>
                            </div>
                            <div class="col-lg-6 ">
                                info
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bookingNumber">Booking Number:</label>
                        <input class="form-control" type="tel" name="bookingNumber" id="bookingNumber" placeholder="booking number.." value="<?= $about['bookingNumber'] ?? '' ?>">
                        <span><?= $_SESSION['errors']['bookingNumber']?? '' ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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