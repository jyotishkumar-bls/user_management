<?php
session_start();
include "../../config/database.php";

$users_id = $_SESSION['user_id'] ?? '';
$users_fullname = $_SESSION['user_fullname'] ?? '';

if(!$users_id){
    header("Location: ../../users/login.php");
    exit();
}

$id = $_GET['id'] ?? '';

if(!$id){
    header("Location: show_teacher.php");
    exit();
}

$sql = "SELECT * FROM teachers WHERE user_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(!$row){
    echo "Teacher not found!";
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];
    $subject = $_POST['subject'];
    $address = $_POST['address'];

    $profile_image = $row['profile_image'];

    if(!empty($_FILES['profile_image']['name'])){

        $target_dir = "../../uploads/";

        if(!is_dir($target_dir)){
            mkdir($target_dir, 0777, true);
        }

        $image_name = time() . "_" . basename($_FILES["profile_image"]["name"]);
        $target_file = $target_dir . $image_name;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);

        if($check !== false && in_array($imageFileType, $allowed_types) && $_FILES["profile_image"]["size"] <= 2000000){
            if(move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)){
                $profile_image = $image_name;
            }
        }
    }

    $sql = "UPDATE teachers SET
            fullname = '$name',
            email = '$email',
            mobile = '$mobile',
            dob = '$dob',
            gender = '$gender',
            qualification = '$qualification',
            subject = '$subject',
            address = '$address',
            profile_image = '$profile_image',
            updated_by = '$users_fullname'
            WHERE user_id = $id";

    if(mysqli_query($conn, $sql)){
        header("Location: teachers.php");
        exit();
    } else {
        echo "Error : " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Teacher</title>

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
                <a href="teachers.php" class="nav-link">
                    <i class="bi bi-person-plus me-2"></i> Teachers
                </a>
            </li>
            <li>
                <a href="show_student.php" class="nav-link">
                    <i class="bi bi-person-plus me-2"></i> Students
                </a>
            </li>

           

            
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

        <div class="bg-white p-3 shadow-sm rounded d-flex justify-content-between align-items-center mb-4">
            <div>
                <i class="bi bi-list me-3"></i>
                <strong>Edit Teacher</strong>
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
                    <h3 class="fw-bold mb-0">Edit Teacher</h3>
                </div>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teacher    ID</label>

                            <input type="text"
                                name="id"
                                class="form-control"
                                value="<?php echo $row['user_id']; ?>"
                                readonly>
                        </div>
                    </div>

                    

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control" 
                                   value="<?php echo $row['fullname']; ?>" 
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
                                       <?php if($row['gender'] == 'Male') echo 'checked'; ?>>
                                <label class="form-check-label">Male</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="gender" 
                                       value="female"
                                       <?php if($row['gender'] == 'Female') echo 'checked'; ?>>
                                <label class="form-check-label">Female</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="gender" 
                                       value="other"
                                       <?php if($row['gender'] == 'Other') echo 'checked'; ?>>
                                <label class="form-check-label">Other</label>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Qualification</label>
                            <select name="qualification" class="form-select" required>
                                <option value="">-- Select Qualification --</option>
                                <option value="B.Sc" <?php if($row['qualification']=="B.Sc") echo "selected"; ?>>B.Sc</option>
                                <option value="M.Sc" <?php if($row['qualification']=="M.Sc") echo "selected"; ?>>M.Sc</option>
                                <option value="PhD" <?php if($row['qualification']=="PhD") echo "selected"; ?>>PhD</option>
                                <option value="MCA" <?php if($row['qualification']=="MCA") echo "selected"; ?>>MCA</option>
                                <option value="B.Sc" <?php if($row['qualification']=="B.Sc") echo "selected"; ?>>B.Sc</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Subject</label>
                            <select name="subject" class="form-select" required>
                                <option value="">-- Select Subject --</option>
                                <option value="Mathematics" <?php if($row['subject']=="Mathematics") echo "selected"; ?>>Mathematics</option>
                                <option value="Physics" <?php if($row['subject']=="Physics") echo "selected"; ?>>Physics</option>
                                <option value="Chemistry" <?php if($row['subject']=="Chemistry") echo "selected"; ?>>Chemistry</option>
                                <option value="Computer Science" <?php if($row['subject']=="Computer Science") echo "selected"; ?>>Computer Science</option>
                            </select>
                        </div>


                        

                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" 
                                    rows="2" 
                                    class="form-control"><?php echo $row['address']; ?></textarea>
                        </div>

                       <div class="mb-4">
                            <label class="form-label">Profile Image</label>

                            <?php if(!empty($row['profile_image'])){ ?>
                                <br>
                                <img src="../../uploads/<?php echo $row['profile_image']; ?>" 
                                    width="90" 
                                    height="90" 
                                    class="rounded mb-2"
                                    style="object-fit: cover;">
                            <?php } ?>

                            <input type="file" name="profile_image" class="form-control">
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle me-2"></i>
                        Update Student
                    </button>

                    <a href="teachers.php" class="btn btn-secondary px-4">
                        Cancel
                    </a>

                </form>

            </div>
        </div>

    </div>

</div>

</body>
</html>