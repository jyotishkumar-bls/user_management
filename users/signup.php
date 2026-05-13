<?php
session_start();
include "../config/database.php";

$error = "";
$success = "";



if($_SERVER["REQUEST_METHOD"] == "POST"){
    $role = $name = $email = $password = $confirm_password = "";

    if(empty($_POST['role'])){
        $error = "Role is required!";
    } else {
        $role = $_POST['role'];
    }

    if(empty($_POST['name']) && empty($error)){
        $error = "Name is required!";
    } elseif(empty($error)) {
        $name = $_POST['name'];
    }

    if(empty($_POST['email']) && empty($error)){
        $error = "Email is required!";
    } elseif(empty($error)) {
        $email = $_POST['email'];
    }

    if(empty($_POST['password']) && empty($error)){
        $error = "Password is required!";
    } elseif(empty($error)) {
        $password = $_POST['password'];
    }

    if(empty($_POST['confirm_password']) && empty($error)){
        $error = "Confirm password is required!";
    } elseif(empty($error)) {
        $confirm_password = $_POST['confirm_password'];
    }

    if(empty($error) && $password != $confirm_password){
        $error = "Passwords do not match!";
    }

    if(empty($error)){
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $check_email);

        if($result && mysqli_num_rows($result) > 0){
            $error = "Email already registered!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (role, name, email, password) VALUES ('$role', '$name', '$email', '$hashed_password')";
            
            if(mysqli_query($conn, $sql)){
                header("Location: login.php?success=account_created");
                exit;
            } else {
                $error = "Database Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

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
    </style>
</head>

<body>

    <div class="login-card mx-auto">

        <div class="top-section">
            <h2>Campus Connect</h2>
            <p>Create your account</p>
        </div>

        <div class="form-section">
            <h3 class="mb-4">Sign Up</h3>

            <?php if(!empty($error)): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                <div class="form-group">
                    <label>Role :</label>  &nbsp;&nbsp;
                    <input type="radio" name="role" value="Student" class="mr-1" required> Student
                    &nbsp;&nbsp;
                    <input type="radio" name="role" value="Staff" class="mr-1" required> Staff
                    &nbsp;&nbsp;
                    <input type="radio" name="role" value="Admin" class="mr-1" required> Staff
                    &nbsp;&nbsp;
                </div>

                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn btn-custom btn-block">
                    Sign Up
                </button>

            </form>

            <p class="text-center mt-4">
                Already have an account?
                <a href="login.php">Login</a>
            </p>

        </div>
    </div>

</body>
</html>


sahi h