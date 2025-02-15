<?php
session_start();
$title = $_REQUEST['title'];
$description = $_REQUEST['description'];
$image = $_FILES['banner_image'];
$_SESSION['banner'] = $_REQUEST;
$id = $_SESSION['banner']['id'];
$extension = pathinfo($image['name'] ?? '', PATHINFO_EXTENSION);
$errors = [];
$banner = [];
define('MAX_SIZE', 1000000);
define('EXTENSIONS', ['jpg', 'png', 'jpeg']);

include "../database/env.php";

// Validation 

if (empty($title)) {
    $errors['title'] = "Title is required";
}

if (empty($description)) {
    $errors['description'] = "Description is required";
}


if ($image['size'] > 0) {
    if (MAX_SIZE < $image['size']) {
        $errors['image'] = " image size must be in 1MB ";
    } else if (!in_array($extension, EXTENSIONS)) {
        $errors['image'] = " image must be "  . implode(', ', EXTENSIONS);
    }
}


// logic
if ($image['size'] > 0) {
    if (!file_exists("../uploads/banner")) {
        mkdir('../uploads/banner',0777,true);
    }
    $fileName = "banner-" . uniqid() . ".$extension";
    $is_uploaded = move_uploaded_file($image['tmp_name'], "../uploads/banner/" . $fileName);
    if(!$is_uploaded) {
        $errors['image'] = " image upload failed ";
    }
    // $query = "INSERT INTO banner(title, description, image) VALUES ('$title','$description','$fileName')";
}else{
    $query = "UPDATE banner SET title='$title',description='$description' ORDER BY id DESC";
}



// IF ERROR OCCURS

if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header('Location: ../dashboard/banner.php');
} else {
    // Database connection
    $query = "UPDATE banner SET title='$title',description='$description',image='$image' WHERE id = '$id' ";
    $result = mysqli_query($conn, $query);
    // print_r($result);
    // exit;
    if ($result) {
        // $_SESSION['banner'] = $_REQUEST;
        $_SESSION['banner']['image '] = $fileName;
        $_SESSION['banner']['title '] = $title;
        $_SESSION['banner']['description '] = $description;
        header('Location: ../index.php');
    }
}