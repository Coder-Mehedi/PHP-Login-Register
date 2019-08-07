<?php

    include('config/db_connect.php');



    $email = $password = $confirmPassword = '';
    $error = ['email' => '', 'password' => '', 'confirmPassword' => ''];
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        if(empty($email)) {
            $error['email'] = "An email is required <br />";
        }elseif(!empty($email)){
            $sql_email = "SELECT * FROM account_info WHERE email='$email'";
            $result = mysqli_query($conn, $sql_email);
            if(mysqli_num_rows($result) > 0) {
                $error['email'] = "Sorry... Email Address Is Already Registered";
            }
        }
        if(empty($password)) {
            $error['password'] = 'password is required <br />';
        }else {
            // echo htmlspecialchars($password);
        }
        if(empty($confirmPassword)) {
            $error['confirmPassword'] = 'Confirm password is required <br />';
        }else {
            if($password !== $confirmPassword) {
                $error['confirmPassword'] = 'Confirm password did not match <br />';
            }else {
                // echo htmlspecialchars($confirmPassword);
            }
        }
        if(array_filter($error)) {
            echo 'errors in the form';
        } else {
            echo 'form is valid';
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = md5($password);
//          create sql
            $sql = "INSERT INTO account_info(email, password) VALUES('$email', '$password')";
            if(mysqli_query($conn, $sql)) {
//               success
                header('Location: index.php');
            }else {
                echo 'query error ' . mysqli_error($conn);

            }
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="style.css">

    <title>Sign Up</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col md6 s6 offset-s3">
            <h1>Sign Up Form</h1>
            <form action="signup.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter Your Email">
                <div class="red-text"><?php echo $error['email'] ?></div>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter Password">
                <div class="red-text"><?php echo $error['password'] ?></div>
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="confirmPassword" placeholder="Confirm Password">
                <div class="red-text"><?php echo $error['confirmPassword'] ?></div>
                <div class="center">
                    <input type="submit" class="btn" name="submit" value="Sign Up" name="">
                </div>
            </form>
            <div class="right">
                <p>already have an account? <a href="index.php">Login</a></p>
            </div>
        </div>
    </div>

</div>
</body>
</html>