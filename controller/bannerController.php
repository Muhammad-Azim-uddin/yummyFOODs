<?php
session_start();
$title = $_REQUEST['title'];
$description = $_REQUEST['description'];
$image = $_FILES['image'];
$extension = pathinfo($image['name'] ?? '', PATHINFO_EXTENSION);

$errors = [];
$banner = [];
define('EXTENSIONS', ['jpg', 'png', 'jpeg']);

include "../database/env.php";

// Validation 

if (empty($title)) {
    $errors['title'] = "Title is required";
}

if (empty($description)) {
    $errors['description'] = "Description is required";
}

if($image['size'] == 0){
    $errors['image'] = "No image selected";
}else if ($image['size'] > 0) {
    if (!in_array($extension, EXTENSIONS)) {
        $errors['image'] = " image must be "  . implode(', ', EXTENSIONS);
    }
}


// logic / file upload part 

$path = "../uploads/banner/";

if (!file_exists($path)) {
    mkdir($path, 0777, true);
}

// check korte hobe,, file upload hoyeche kina,,
$fileName = "banner-" . uniqid() . ".$extension";
move_uploaded_file($image['tmp_name'], $path . "/" . $fileName);


// IF ERROR OCCURS

if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header('Location: ../dashboard/banner.php');
} else {
    // data update in database or data insert in database

    $query = "SELECT * FROM banner LIMIT 1"; 
    $result = mysqli_query($conn, $query);
 
    if ($result -> num_rows > 0) {
        $banner = mysqli_fetch_assoc($result);
        if ($banner['image']){
            unlink("../uploads/banner/" . $banner['image']);
        }
        $query = "UPDATE banner SET title='$title',description='$description',image='$fileName' ";
 
    }else{
        // data insert
        $query = "INSERT INTO banner(title, description) VALUES ('$title','$description','$fileName')";
        $result = mysqli_query($conn, $query);
    }
    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['banner']['image'] = $fileName;
        $_SESSION['banner']['title'] = $title;
        $_SESSION['banner']['description'] = $description;
        header('Location: ../index.php');
    }
}