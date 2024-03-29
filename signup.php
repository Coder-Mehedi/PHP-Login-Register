<?php

    include('config/db_connect.php');
    session_start();


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
//             $sql = "INSERT INTO account_info(email, password) VALUES('$email', '$password')";
//             if(mysqli_query($conn, $sql)) {
// //               success
//                 header('Location: login.php');
//             }else {
//                 echo 'query error ' . mysqli_error($conn);

//             }
            $sql = "INSERT INTO account_info(email, password) VALUES(?,?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed";
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $email, $password);
                mysqli_stmt_execute($stmt);
                header('Location: login.php');
            }
        }
    }
?>
<?php include 'templates/header.php'; ?>
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
                <p>already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>

</div>
<?php include 'templates/footer.php'; ?>