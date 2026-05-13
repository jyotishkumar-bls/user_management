<?php
session_start();
include "../../config/database.php";
$id=$_GET['id'];
$sql="SELECT * FROM students WHERE id=$id";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $batch_name = $_POST['batch_name'];
    $address = $_POST['address'];


    $sql="UPDATE students SET
            name='$name',
            email='$email',
            mobile='$mobile',
            dob = '$dob',
            gender='$gender',
            course = '$course',
            batch_name = '$batch_name',
            address='$address'   
            WHERE id = $id";

        if(mysqli_query($conn , $sql)){
            header("Location: show_student.php");
        
        }else{
            echo "Error : ".mysqli_error($conn);
      
           }

}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
</head>

<body>

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
                <a href="add_student.php" class="nav-link">
                    <i class="bi bi-person-plus me-2"></i> Add Student
                </a>
            </li>

            <li>
                <a href="show_student.php" class="nav-link">
                    <i class="bi bi-table me-2"></i> Show Students
                </a>
            </li>

            <li>
                <a href="#" class="nav-link active-menu">
                    <i class="bi bi-pencil me-2"></i> Edit Student
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

        <div class="bg-white p-3 shadow-sm rounded d-flex justify-content-between align-items-center mb-4">
            <div>
                <i class="bi bi-list me-3"></i>
                <strong>Edit Student</strong>
            </div>

            <div>
                <i class="bi bi-bell me-3"></i>
                <span class="fw-bold">Admin</span>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                <div class="d-flex align-items-center mb-4">
                    <i class="bi bi-pencil-square text-primary fs-3 me-2"></i>
                    <h3 class="fw-bold mb-0">Edit Student</h3>
                </div>

                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Student ID</label>

                            <input type="text"
                                name="id"
                                class="form-control"
                                value="<?php echo $row['id']; ?>"
                                readonly>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control" 
                                   value="<?php echo $row['name']; ?>" 
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control" 
                                   value="<?php echo $row['email']; ?>" 
                                   required>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" 
                                   name="mobile" 
                                   class="form-control" 
                                   value="<?php echo $row['mobile']; ?>" 
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" 
                                   name="dob" 
                                   class="form-control" 
                                   value="<?php echo $row['dob']; ?>" 
                                   required>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label d-block">Gender</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="gender" 
                                       value="male"
                                       <?php if($row['gender'] == 'male') echo 'checked'; ?>>
                                <label class="form-check-label">Male</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="gender" 
                                       value="female"
                                       <?php if($row['gender'] == 'female') echo 'checked'; ?>>
                                <label class="form-check-label">Female</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="gender" 
                                       value="other"
                                       <?php if($row['gender'] == 'other') echo 'checked'; ?>>
                                <label class="form-check-label">Other</label>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Course</label>
                            <input type="text" 
                                   name="course" 
                                   class="form-control" 
                                   value="<?php echo $row['course']; ?>" 
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Batch Name</label>
                            <input type="text" 
                                   name="batch_name" 
                                   class="form-control" 
                                   value="<?php echo $row['batch_name']; ?>" 
                                   required>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" 
                                  rows="2" 
                                  class="form-control"><?php echo $row['address']; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle me-2"></i>
                        Update Student
                    </button>

                    <a href="show_students.php" class="btn btn-secondary px-4">
                        Cancel
                    </a>

                </form>

            </div>
        </div>

    </div>

</div>

</body>
</html>