
<?php
session_start();
include "../../config/database.php";

$nameErr = $emailErr = $mobileErr = $courseErr = $batchErr = "";
$name = $email = $mobile = $dob = $gender = $address = $course = $batch_name = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty($_POST['name'])){
        $nameErr = "Name is required!";
    } else {
        $name = trim($_POST['name']);

        if(!preg_match("/^[a-zA-Z ]+$/", $name)){
            $nameErr = "Only alphabets and spaces allowed!";
        }
    }

    if(empty($_POST['email'])){
        $emailErr = "Email is required!";
    } else {
        $email = trim($_POST['email']);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "Invalid email format!";
        }
    }

    if(empty($_POST['mobile'])){
        $mobileErr = "Mobile number is required!";
    } else {
        $mobile = trim($_POST['mobile']);

        if(!preg_match("/^[0-9]{10}$/", $mobile)){
            $mobileErr = "Enter valid 10 digit mobile number!";
        }
    }

    if(empty($_POST['course'])){
        $courseErr = "Course is required!";
    } else {
        $course = trim($_POST['course']);

        if(!preg_match("/^[a-zA-Z ]+$/", $course)){
            $courseErr = "Only alphabets allowed in course!";
        }
    }

    if(empty($_POST['batch_name'])){
        $batchErr = "Batch name is required!";
    } else {
        $batch_name = trim($_POST['batch_name']);

        if(!preg_match("/^[a-zA-Z0-9 ]+$/", $batch_name)){
            $batchErr = "Invalid batch name!";
        }
    }

    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    if(
        empty($nameErr) &&
        empty($emailErr) &&
        empty($mobileErr) &&
        empty($courseErr) &&
        empty($batchErr)
    ){



        $sql = "INSERT INTO students 
        (name, email, mobile, gender, dob, course, batch_name, address) 
        VALUES 
        ('$name', '$email', '$mobile', '$gender', '$dob', '$course', '$batch_name', '$address')";

        $result = mysqli_query($conn, $sql);

        if($result){
            
            header("Location: ../../profile/admin/show_student.php");
            
        } else {
            echo "Data not inserted: " . mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Student</title>

    <style>
    body {
        background: #f4f7fb;
    }

    .sidebar {
        width: 260px;
        min-height: 100vh;
        background: #0f172a;
    }

    .sidebar .nav-link {
        color: white;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 8px;
    }

    .sidebar .nav-link:hover,
    .active-menu {
        background: #2563eb;
    }

    .main-content {
        width: calc(100% - 260px);
    }
</style>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<body class="bg-light">

<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar text-white p-3">

        <h5 class="mb-4">
            <i class="bi bi-mortarboard-fill me-2"></i>
            Admin Dashboard
        </h5>

        <small class="text-secondary">MENU</small>

        <ul class="nav flex-column mt-3">

            <li>
                <a href="dashboard.php" class="nav-link">
                    <i class="bi bi-house me-2"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="add_student.php" class="nav-link active-menu">
                    <i class="bi bi-person-plus me-2"></i> Add Student
                </a>
            </li>

            <li>
                <a href="show_student.php" class="nav-link">
                    <i class="bi bi-table me-2"></i> Show Students
                </a>
            </li>

            

           

            <hr>

            <li>
                <a href="#" class="nav-link">
                    <i class="bi bi-person me-2"></i> Profile
                </a>
            </li>

            <li>
                <a href="#" class="nav-link">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </li>

        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content p-4">

        <!-- Topbar -->
        <div class="bg-white p-3 shadow-sm rounded d-flex justify-content-between align-items-center mb-4">

            <div>
                <i class="bi bi-list me-3"></i>
                <strong>Add Student</strong>
            </div>

            <div>
                <i class="bi bi-bell me-3"></i>
                <span class="fw-bold">Admin</span>
            </div>

        </div>

        <!-- Form Card -->
        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-4">

                <div class="d-flex align-items-center mb-4">
                    <i class="bi bi-person-plus-fill text-primary fs-3 me-2"></i>
                    <h3 class="fw-bold mb-0">Add Student</h3>
                </div>

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" name="mobile" class="form-control" placeholder="Enter mobile number" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label d-block">Gender</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="male" required>
                                <label class="form-check-label">Male</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="female" required>
                                <label class="form-check-label">Female</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="other" required>
                                <label class="form-check-label">Other</label>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Course</label>
                            <input type="text" name="course" class="form-control" placeholder="Enter course" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Batch Name</label>
                            <input type="text" name="batch_name" class="form-control" placeholder="Enter batch name" required>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" rows="2" class="form-control" placeholder="Enter address"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Profile Image</label>
                        <input type="file" name="profile_image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-plus-circle me-2"></i>
                        Add Student
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>