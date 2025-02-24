<?php
$id = $_REQUEST['id'];
include '../database/env.php';
$query = "DELETE FROM `categories` WHERE id =' $id'";
$result = mysqli_query($conn, $query);
if ($result){
    header('Location:../dashboard/category.php');
}


?>