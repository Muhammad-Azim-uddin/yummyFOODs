<?php
session_start();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$encPassword =  password_hash($password, PASSWORD_BCRYPT);
$confirm_password = $_POST['confirm_password'];
$errors = [];

include '../database/env.php';

if (empty($first_name)) {
    $errors['first_name'] = "First name is required";
} else if (strlen($first_name) > 61) {
    $errors['first_name'] = "First name should be less than 61 characters";
}

if (empty($email)) {
    $errors['email'] = "Email is required";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format";
}else {
    $query = "SELECT email FROM user WHERE email = '$email' ";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0){
        $errors['email'] = "Email already exists";
    }
}


if (empty($password)) {
    $errors['password'] = "Password is required";
}

if($password!== $confirm_password) {
    $errors['confirm_password'] = "Passwords do not match";
}

if (count($errors) > 0) {

    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header("Location: ../register.php");
} else {
    // store
    $query = "INSERT INTO user(first_name, last_name, email, password) VALUES ('$first_name','$last_name','$email','$encPassword')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['user'] = $_REQUEST;
        header("Location: ../dashboard/index.php");
    }
}
