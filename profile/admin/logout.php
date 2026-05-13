<?php
include "../../config/database.php";
session_start();

session_unset();   // saare session variables remove
session_destroy(); // session destroy

header("Location: ../../users/login.php");
exit();
?>