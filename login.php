<?php
session_start();

include('config/db_connect.php');

//    write query for all users
    $sql = 'SELECT email, password, id FROM account_info ORDER BY created_at';

//    getting result
    $result = mysqli_query($conn, $sql);

//    fetch the resulting rows
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

//    free the result from memory
    mysqli_free_result($result);

//    close the connection
    // mysqli_close($conn);
    
    $email = $password = '';
    $error = ['email' => '', 'password' => '', 'invalid' => ''];
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(empty($email)) {
            $error['email'] = "An email is required <br />";
        }else {
            // echo htmlspecialchars($email);
        }
        if(empty($password)) {
            $error['password'] = 'password is required <br />';
        }else {
            // echo htmlspecialchars($password);
        }
        if(array_filter($error)) {
            echo 'errors in the form';
        } else {
            // echo 'form is valid';
            $email = stripcslashes($email);
            $password = stripcslashes($password);

            $sql = "SELECT * FROM account_info WHERE email='$email' AND password='".md5($password)."'";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) == 1) {
                $_SESSION['email'] = $email;
                echo 'Login Successfull';
                echo $_SESSION['email'];
                header("Location: index.php");
            } else {
                $error['invalid'] = "Email or Password is incorrect.";
            }

        }
    }
?>

<?php include 'templates/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col md6 s6 offset-s3">
                <?php if(!isset($_SESSION['email'])): ?>
                <h1>Login Form</h1>
                <form action="login.php" method="POST">
                    <label for="email">Email</label>
                    <input type="email" name="email">
                    <div class="red-text"><?php echo $error['email'] ?></div>
                    <label for="password">Password</label>
                    <input type="password" name="password">
                    <div class="red-text"><?php echo $error['password'] ?></div>
                    <div class="center">
                        <input type="submit" class="btn" name="submit" value="Login">
                    </div>
                    <div class="red-text"><?php echo $error['invalid']; ?></div>
                </form>
                <div class="right">
                    <p>don't have an account? <a href="signup.php">Sign Up</a></p>
                </div>
                <?php else: ?>
                    <h4>You are already Logged in as <?php echo $_SESSION['email']; ?></h4>
                    <a href="logout.php">Logout</a>
                <?php endif ?>
            </div>
        </div>
        <!-- <div class="row">
            <ul class="collection center col s6 offset-s3">
                <?php foreach($users as $user):?>
                    <li class="collection-item"><?php echo $user['email']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div> -->
    </div>
<?php include 'templates/footer.php'; ?>