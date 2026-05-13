<?php
session_start();
include "../config/database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
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
        }
    </style>
</head>

<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar text-white p-3">

        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-mortarboard-fill mr-2"></i>
            <h4 class="mb-0">Admin Dashboard</h4>
        </div>

        <small class="text-uppercase text-secondary">Menu</small>

        <ul class="nav flex-column mt-3">

            <li class="nav-item mb-2">
                <a href="#" class="nav-link active-menu text-white">
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
                <a href="#" class="nav-link text-white">
                    <i class="bi bi-person mr-2"></i> Profile
                </a>
            </li>

            <li class="nav-item">
                <a href="logout.php" class="nav-link text-white">
                    <i class="bi bi-box-arrow-right mr-2"></i> Logout
                </a>
            </li>

        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-grow-1 p-4">

        <!-- Topbar -->
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
                    <img src="jyotish.png" class="rounded-circle" width="50" height="50">

                    <div class="ml-2">
                        <h6 class="mb-0 font-weight-bold">Admin</h6>
                        <small class="text-muted">Super Admin</small>
                    </div>
                </div>

            </div>
        </div>

        <!-- Dashboard Row -->
        <div class="row mt-4">

            <!-- Left Section -->
            <div class="col-md-8">

                <div class="bg-primary text-white p-5 rounded">
                    <h2>Welcome Back Admin 👋</h2>
                    <p class="mb-0">Manage student details easily from dashboard.</p>
                </div>

                <div class="row mt-4">

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

            <!-- Right Section -->
            <div class="col-md-4">

                <div class="card border-0 shadow-sm profile-card  text-center">

                    <h5 class="text-primary font-weight-bold mb-4">Admin Profile</h5>

                    <img src="jyotish.png"
                         class="rounded-circle mx-auto d-block mb-3"
                         width="120"
                         height="">

                    <h4 class="font-weight-bold">Admin</h4>

                    <p class="text-primary">Super Admin</p>

                    <p class="text-muted mb-2">
                        <i class="bi bi-envelope mr-2"></i>
                        admin@gmail.com
                    </p>

                    <p class="text-muted">
                        <i class="bi bi-calendar mr-2"></i>
                        Joined on 01 Jan 2024
                    </p>

                </div>

            </div>

        </div>

        <!-- Table Section -->
        <!-- <div class="card mt-4 border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between mb-3">
                    <h4>Student Details</h4>
                    <button class="btn btn-primary">Add Student</button>
                </div>

                <table class="table table-hover">

                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Rahul</td>
                            <td>rahul@gmail.com</td>
                            <td>
                                <span class="badge badge-success">Active</span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">View</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    </tbody>

                </table>

            </div>

        </div> -->

    </div>

</div>

</body>
</html>