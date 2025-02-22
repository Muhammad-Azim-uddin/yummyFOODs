<?php
session_start();

$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$email = $_REQUEST['email'];
$id = $_SESSION['user']['id'];
$errors = [];
$profile_image = $_FILES['profile_image'];


$extension = pathinfo($profile_image['name'], PATHINFO_EXTENSION);
define('MAX_SIZE', 1000000);
define('EXTENSIONS', ['jpg', 'png', 'jpeg']);

include "../database/env.php";
if ($profile_image['size'] > 0) {

    if (MAX_SIZE < $profile_image['size']) {
        $errors['profile_image'] = "profile image size must be in 1MB ";
    } else if (!in_array($extension, EXTENSIONS)) {
        $errors['profile_image'] = "profile image must be "  . implode(', ', EXTENSIONS);
    }
}

if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header("Location: ../dashboard/profile.php");
} else {
    // upload
    if ($profile_image['size'] > 0) {
        if (!file_exists("../uploads/users")) {
            mkdir("../uploads/users");
        }
        $fileName = "user-" . uniqid() . ".$extension";
        $is_uploaded = move_uploaded_file($profile_image['tmp_name'], "../uploads/users/" . $fileName);
        $query = "UPDATE user SET first_name='$first_name',last_name='$last_name',email='$email', profile_image='$fileName' WHERE id ='$id' ";
    } else {
        $query = "UPDATE user SET first_name ='$first_name',last_name ='$last_name',email ='$email' WHERE id ='$id' ";
        $fileName = $_SESSION['user']['profile_image'] ;
    }

    mysqli_query($conn, $query);
    $_SESSION['user']['profile_image'] = $fileName;
    $_SESSION['user']['first_name'] = $first_name;
    $_SESSION['user']['last_name'] = $last_name;
    $_SESSION['user']['email'] = $email;
    header("Location: ../dashboard/profile.php");
}
