<?php
include_once "../database/env.php";

$title =  $_REQUEST['title'];
$id =  $_REQUEST['id'];

if($id){
    $query  = "UPDATE categories SET title='$title' WHERE id = '$id'";
} 
else{
    $query  = "INSERT INTO categories(title) VALUES ('$title')";
}

$result = mysqli_query($conn, $query);


if($result){
    header("Location: ../dashboard/category.php");
}