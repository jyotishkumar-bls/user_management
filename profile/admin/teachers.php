<?php

session_start();
include "../../config/database.php";

$role = $_SESSION['user_role'] ?? '';
$user_id = $_SESSION['user_id'] ?? '';

if(!$user_id){
    header("Location: ../../users/login.php");
    
}

$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1){
    $page = 1;
}

$start = ($page - 1) * $limit;

$total_sql = "SELECT COUNT(*) AS total FROM teachers WHERE is_deleted = 0";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);

$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

$sql = "SELECT * FROM teachers 
        WHERE is_deleted = 0 
        ORDER BY id DESC 
        LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Teachers</title>

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

        .student-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
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

            <li class="nav-item mb-2">
                <a href="teachers.php" class="nav-link text-white">
                    <i class="bi bi-person-plus mr-2"></i> Teachers
                </a>
            </li>

            

             <li class="nav-item mb-2">
                <a href="show_student.php" class="nav-link text-white">
                    <i class="bi bi-person-plus mr-2"></i>  Students
                </a>
            </li>


            <!-- <li>
                <a href="edit_student.php" class="nav-link">
                    <i class="bi bi-pencil me-2"></i> Edit Student
                </a>
            </li> -->

           

            <hr>

            <li>
                <a href="profile.php" class="nav-link">
                    <i class="bi bi-person me-2"></i> Profile
                </a>
            </li>

            <li>
                <a href="logout.php" class="nav-link">
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
                <strong>Show Teachers</strong>
            </div>

            <div>
                <i class="bi bi-bell me-3"></i>
                <span class="fw-bold">Admin</span>
            </div>
        </div>

        <!-- Teachers Table -->
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold mb-0">Teachers List</h5>
                        <small class="text-muted">Manage all teachers from here.</small>
                    </div>

                    <a href="add_teacher.php" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>
                        Add New Teacher
                    </a>
                </div>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Subject</th>
                                <th>Qualification</th>
                                <th>created_by</th>
                                <th>updated_by</th>
                               
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php
                        if(mysqli_num_rows($result) > 0){
                            $i = $start + 1;

                            while($row = mysqli_fetch_assoc($result)){
                        ?>

                            <tr>
                                <td><?php echo $i++; ?></td>

                                <td><?php echo $row['fullname']; ?></td>

                                <td><?php echo $row['email']; ?></td>

                                <td><?php echo $row['mobile']; ?></td>

                                <td><?php echo $row['subject']; ?></td>

                                <td><?php echo $row['qualification']; ?></td>

                                <td><?php echo $row['created_by']; ?></td>

                                <td><?php echo $row['updated_by']; ?></td>

                                

                                <td>
                                    <a href="view_teacher.php?id=<?php echo $row['user_id']; ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="edit_teacher.php?id=<?php echo $row['user_id']; ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="delete_teacher.php?id=<?php echo $row['user_id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this teacher?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php
                            }
                        } else {
                        ?>

                            <tr>
                                <td colspan="9" class="text-center text-muted">
                                    No teachers found
                                </td>
                            </tr>

                        <?php
                        }
                        ?>

                        </tbody>

                    </table>

                    <?php if($total_pages > 1){ ?>
                        <?php 
                            $start_page = max(1, $page - 2);
                            $end_page = min($total_pages, $page + 2);
                        ?>
                        <nav>
                            <ul class="pagination justify-content-center mt-3">

                                <?php if($page > 1){ ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                                    </li>
                                <?php } ?>

                                <?php for($p = $start_page; $p <= $end_page; $p++){ ?>
                                    <li class="page-item <?php if($page == $p) echo 'active'; ?>">
                                        <a class="page-link" href="?page=<?php echo $p; ?>">
                                            <?php echo $p; ?>
                                        </a>
                                    </li>
                                <?php } ?>

                                <?php if($page < $total_pages){ ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                                    </li>
                                <?php } ?>

                            </ul>
                        </nav>
                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>