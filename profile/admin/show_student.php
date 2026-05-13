<?php
session_start();
include "../../config/database.php";

$sql = "SELECT * FROM students ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Students</title>

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

            <li>
                <a href="add_student.php" class="nav-link">
                    <i class="bi bi-person-plus me-2"></i> Add Student
                </a>
            </li>

            <li>
                <a href="show_students.php" class="nav-link active-menu">
                    <i class="bi bi-table me-2"></i> Show Students
                </a>
            </li>

            <!-- <li>
                <a href="edit_student.php" class="nav-link">
                    <i class="bi bi-pencil me-2"></i> Edit Student
                </a>
            </li> -->

           

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
                <strong>Show Students</strong>
            </div>

            <div>
                <i class="bi bi-bell me-3"></i>
                <span class="fw-bold">Admin</span>
            </div>
        </div>

        <!-- Students Table -->
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold mb-0">Students List</h5>
                        <small class="text-muted">Manage all students from here.</small>
                    </div>

                    <a href="add_student.php" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>
                        Add New Student
                    </a>
                </div>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Course</th>
                                <th>Batch</th>
                               
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php
                        if(mysqli_num_rows($result) > 0){
                            $i = 1;

                            while($row = mysqli_fetch_assoc($result)){
                        ?>

                            <tr>
                                <td><?php echo $i++; ?></td>

                                <td>
                                    <img src="profile.jpg" class="student-img">
                                </td>

                                <td><?php echo $row['name']; ?></td>

                                <td><?php echo $row['email']; ?></td>

                                <td><?php echo $row['mobile']; ?></td>

                                <td><?php echo $row['course']; ?></td>

                                <td><?php echo $row['batch_name']; ?></td>

                                

                                <td>
                                    <a href="view_student.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="delete_student.php?id=<?php echo $row['id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this student?')">
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
                                    No students found
                                </td>
                            </tr>

                        <?php
                        }
                        ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>