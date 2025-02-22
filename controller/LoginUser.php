<?php
session_start();

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$errors = [];
$user = [];

include '../database/env.php';

if (empty($email)) {
    $errors['email'] = "Enter your email..";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format";
}


if (empty($password)) {
    $errors['password'] = "Enter your password..";
}
 
// login logic 

include '../database/env.php';

$query = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn, $query);

// print_r($user);
// exit();

if ($result->num_rows == 0) {
    $errors['email'] = "email not found";
}else{
    $user = mysqli_fetch_assoc($result);
    if(!password_verify($password , $user['password'])){
        $errors["password"] = "Invalid password";
    }
}




if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header('Location: ../login.php');
} else {
    $_SESSION['user'] = $user;
    header('Location:../dashboard/index.php');
    exit;
}
