<?php
session_start();
include "../config/database.php";

$error = "";

function test_input($data){
    return htmlspecialchars(stripslashes(trim($data)));
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty($_POST['email'])){
        $error = "Email is required!";
    } else {
        $email = test_input($_POST['email']);
    }

    if(empty($_POST['password']) && empty($error)){
        $error = "Password is required!";
    } elseif(empty($error)) {
        $password = $_POST['password'];
    }

    if(empty($error)){
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if($result && mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['password'])){

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_role'] = $row['role'];

                if($row['role'] == "Student"){
                    header("Location: ../profile/student/dashboard.php");
                } elseif ($row['role'] == "Staff") {
                    header("Location: ../profile/staff/dashboard.php");
                } elseif ($row['role'] == "Admin") {
                    header("Location: ../profile/admin/dashboard.php");
                }
                exit;

            } else {
                $error = "Invalid Password";
            }

        } else {
            $error = "Email not found";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background: #2f946f;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 380px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            background: #fff;
        }

        .top-section {
            background: linear-gradient(135deg, #b8e4d6, #7fc3ad);
            padding: 40px;
            color: white;
        }

        .form-section {
            padding: 35px;
            border-radius: 35px 35px 0 0;
            margin-top: -25px;
            background: white;
        }

        .btn-custom {
            background: #005f52;
            color: white;
            border-radius: 8px;
        }

        .btn-custom:hover {
            color: white;
            background: #00483f;
        }

        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 1px solid #ddd;
            background: white;
            margin: 5px;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 mb-4">
            <div class="login-card mx-auto">

                <div class="top-section">
                    <h1>Campus Connect</h1>
                    <p>Smart student management solution</p>
                </div>

                <div class="form-section">
                    <h3 class="mb-4">Login</h3>

                    <?php if(!empty($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($_GET['success']) && $_GET['success'] == 'account_created'): ?>
                        <div class="alert alert-success">
                            Account created successfully! Please login.
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST">

                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <p class="text-right">
                            <a href="#">Forgot Password?</a>
                        </p>

                        <button type="submit" class="btn btn-custom btn-block">
                            Login
                        </button>

                    </form>

                    <p class="text-center mt-4">
                        Don’t have an account?
                        <a href="signup.php">Sign Up</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>