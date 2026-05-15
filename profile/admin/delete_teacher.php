<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include "../../config/database.php";

$user_id = $_SESSION['user_id'] ?? '';

if(!$user_id){
    header("Location: ../../users/login.php");
    exit();
}

$id = $_GET['id'];

$sql = "UPDATE teachers 
        SET is_deleted = 1 
        WHERE user_id = $id";

if(mysqli_query($conn, $sql)){
    header("Location: teachers.php");
    exit();
}else{
    echo "Error : " . mysqli_error($conn);
}
?>