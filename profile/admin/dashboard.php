<?php
session_start();
include "../../config/database.php";

$user_id = $_SESSION['user_id'] ?? '';


if(!$user_id){
    header("Location: ../../users/login.php");
    exit();
}

$sql = "SELECT * FROM admins WHERE user_id = $user_id";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(empty($row)){
    die("Admin details not found!");
}else{
    
}

$profile_image = !empty($row['profile_image'])
    ? "../../uploads/" . $row['profile_image']
    : "../../uploads/default.png";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            background: #f1f5f9;
        }

        .sidebar {
            width: 260px;
            background: #0f172a;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            border-radius: 10px;
            padding: 12px;
            transition: 0.3s;
        }

        .sidebar .nav-link:hover,
        .active-menu {
            background: #2563eb;
        }

        .main-content {
            width: calc(100% - 260px);
        }

        .profile-card {
            border-radius: 20px;
            padding: 30px;
        }

        img {
            object-fit: cover;
        }
    </style>
</head>

<body>

<div class="d-flex">

    <div class="sidebar text-white p-3">

        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-mortarboard-fill mr-2"></i>
            <h4 class="mb-0">Admin Dashboard</h4>
        </div>

        <small class="text-uppercase text-secondary">Menu</small>

        <ul class="nav flex-column mt-3">

            <li class="nav-item mb-2">
                <a href="dashboard.php" class="nav-link active-menu text-white">
                    <i class="bi bi-house-fill mr-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="add_student.php" class="nav-link text-white">
                    <i class="bi bi-person-plus mr-2"></i> Add Student
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="show_student.php" class="nav-link text-white">
                    <i class="bi bi-table mr-2"></i> Show Students
                </a>
            </li>

            <hr class="bg-secondary">

            <li class="nav-item mb-2">
                <a href="profile.php" class="nav-link text-white">
                    <i class="bi bi-person mr-2"></i> Profile
                </a>
            </li>

            <li class="nav-item">
               <a href="../../users/logout.php" class="nav-link text-white">
                    <i class="bi bi-box-arrow-right mr-2"></i> Logout
                </a>
            </li>

        </ul>
    </div>

    <div class="main-content flex-grow-1 p-4">

        <div class="bg-white shadow-sm rounded p-3 d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center">
                <i class="bi bi-list h3 mr-3 mb-0"></i>
                <h5 class="mb-0 font-weight-bold">Dashboard</h5>
            </div>

            <div class="d-flex align-items-center">

                <div class="position-relative mr-4">
                    <i class="bi bi-bell h5"></i>
                    <span class="badge badge-danger position-absolute" style="top:-10px; right:-10px;">
                        3
                    </span>
                </div>

                <div class="d-flex align-items-center">
                  

                    <a href="profile.php">

                        <img src="<?php echo $profile_image; ?>"
                            class="rounded-circle"
                            width="50"
                            height="50"
                            style="object-fit: cover; cursor: pointer;">

                    </a>
                       

                    <div class="ml-2">
                        <h6 class="mb-0 font-weight-bold">
                            <?php echo $row['fullname']; ?>
                        </h6>
                        <small class="text-muted">Super Admin</small>
                    </div>
                </div>

            </div>
        </div>

        <div class="row mt-4">

            <div class="col-md-8">

                <div class="bg-primary text-white p-5 rounded">
                    <h2>Welcome Back <?php echo $row['name']; ?> 👋</h2>
                    <p class="mb-0">Manage student details easily from dashboard.</p>
                </div>

                <div class="row mt-5">

                    <div class="col-md-4 mb-3">
                        <div class="card p-4 shadow-sm border-0">
                            <h5>Total Students</h5>
                            <h2>120</h2>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card p-4 shadow-sm border-0">
                            <h5>Active Students</h5>
                            <h2>95</h2>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card p-4 shadow-sm border-0">
                            <h5>Inactive Students</h5>
                            <h2>25</h2>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4">

                <div class="card border-0 shadow-sm profile-card text-center">

                    <h5 class="text-primary font-weight-bold mb-4">Admin Profile</h5>

                      <a href="profile.php">

                        <img src="<?php echo $profile_image; ?>"
                            class="rounded-circle"
                            width="200"
                            height="200"
                            style="object-fit: cover; cursor: pointer;">

                        </a>

                    <h4 class="font-weight-bold">
                        <?php echo $row['name']; ?>
                    </h4>

                    <p class="text-primary">Super Admin</p>

                    <p class="text-muted mb-2">
                        <i class="bi bi-envelope mr-2"></i>
                        <?php echo $row['email']; ?>
                    </p>

                    <p class="text-muted">
                        <i class="bi bi-phone mr-2"></i>
                        <?php echo $row['mobile']; ?>
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>