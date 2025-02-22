<?php
session_start();
include "../database/env.php";
$title = $_REQUEST['title'];
$bookingNumber = $_REQUEST['bookingNumber'];
$aboutImage = $_FILES['aboutImage'];
$extension = pathinfo($aboutImage['name'], PATHINFO_EXTENSION);
$errors = [];
// print_r($aboutImage);
// exit;

if (empty($title)) {
    $errors['title'] = "Please enter a title";
}

if (empty($bookingNumber)) {
    $errors['bookingNumber'] = "Please enter a booking number";
}

// image validation
$allowed_extensions = ['jpg', 'jpeg', 'png'];
if ($aboutImage['size'] > 0) {
    $extension = pathinfo($aboutImage['name'], PATHINFO_EXTENSION);

    if (!in_array($extension, $allowed_extensions)) {
        $errors['aboutImage'] = "Only JPG, JPEG, and PNG are allowed.";
    }
    if ($aboutImage['size'] > 1000000) { // 1MB limit
        $errors['aboutImage'] = "Image size must be less than 1MB.";
    }
}
$path = "../uploads/about";
if (!file_exists($path)) {
    mkdir($path);
}




if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header('Location:../dashboard/about.php');
    exit;
}

// data store or data update in database
$query = "SELECT * FROM about";
$result = mysqli_query($conn, $query);
$about = mysqli_fetch_assoc($result);

if ($aboutImage['size'] > 0) {

    // nicher 2 line code bujhi nai,,, 
    if (!empty($about['aboutImage']) && file_exists($path . "/" . $about['aboutImage'])) {   
        unlink($path . "/" . $about['aboutImage']); // Delete old image
    }
    $fileName = "about-" . uniqid() . "." . $extension;
    move_uploaded_file($aboutImage['tmp_name'], $path . "/" . $fileName);
} else {
    // data insert
    $fileName = $about['aboutImage'] ?? NULL;
}

if ($about) {
    if ($aboutImage['size'] > 0) {
        $query = "UPDATE about SET title='$title', bookingNumber='$bookingNumber', aboutImage='$fileName' WHERE id={$about['id']}";
    } else {
        $query = "UPDATE about SET title='$title', bookingNumber='$bookingNumber' WHERE id={$about['id']}" ;
    }
} else {
    $query = "INSERT INTO about (title, bookingNumber, aboutImage) VALUES ('$title', '$bookingNumber', '$fileName') WHERE id={$about['id']}";
}



$result2 = mysqli_query($conn, $query);
if ($result2) {
    $_SESSION['about']['aboutImage'] = $fileName;
    $_SESSION['about']['title'] = $title;
    $_SESSION['about']['bookingNumber'] = $bookingNumber;
    header('Location:../dashboard/about.php');
    exit;
}
