<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include "../../config/database.php";

$role = $_SESSION['user_role'] ?? '';
$user_id = $_SESSION['user_id'] ?? '';

if(!$user_id){
    header("Location: ../../users/login.php");
    
}

$id = $_GET['id'];
$sql = "DELETE FROM students WHERE id=$id";
if(mysqli_query($conn,$sql)){
    header("Location:show_student.php");
    
}else{
    echo "Error : ".mysqli_error($conn);
}
?>