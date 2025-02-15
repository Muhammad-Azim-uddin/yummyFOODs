<?php 
session_start();
$old_password = $_REQUEST['old_password'];
$new_password = $_REQUEST['new_password'];
$encPassword = password_hash($new_password, PASSWORD_BCRYPT);
$confirm_password = $_REQUEST['confirm_password'];
$errors = [];

$id = $_SESSION['user']['id'];
include '../database/env.php';

// validation 

$old = $_SESSION['user']['password'];
// print_r("pass is " . $old);
// exit;

if (empty($new_password)){
    $errors['new_password'] = "Please enter a new password";
}

if ($new_password!== $confirm_password){
    $errors['confirm_password'] = 'passwords do not match';
}
 

// logic 

if(!password_verify( $old_password, $old)){
    $errors['old_password'] = 'password is not correct';
    echo "password verification failed";
}

if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    header('Location: ../dashboard/profile.php');
    exit;
}else{
    $query = "UPDATE user SET password='$encPassword' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $_SESSION['user']['password'] = $encPassword;
    header("Location:../dashboard/profile.php");
    exit;
}

?>