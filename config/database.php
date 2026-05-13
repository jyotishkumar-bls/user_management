<?php
$host="localhost";
$user="root";
$password="phpmyadmin";
$database="student_management_app";
$conn = mysqli_connect($host,$user,$password,$database);
if(!$conn){
    die("connection Failed : ".mysqli_connect_error());
}else{
    //echo "Database connected Successfully!";
}
?>