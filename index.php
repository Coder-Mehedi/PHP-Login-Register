<?php
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
    mysqli_close($conn);
    



    $email = $password = '';
    $error = ['email' => '', 'password' => ''];
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
            echo 'form is valid';
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

    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col md6 s6 offset-s3">
                <h1>Login Form</h1>
                <form action="index.php" method="POST">
                    <label for="email">Email</label>
                    <input type="email" name="email">
                    <div class="red-text"><?php echo $error['email'] ?></div>
                    <label for="password">Password</label>
                    <input type="password" name="password">
                    <div class="red-text"><?php echo $error['password'] ?></div>
                    <div class="center">
                        <input type="submit" class="btn" name="submit" value="Login">
                    </div>
                </form>
                <div class="right">
                    <p>don't have an account? <a href="signup.php">Sign Up</a></p>
                </div>
            </div>
        </div>
        <div class="row">
            <ul class="collection center col s6 offset-s3">
                <?php foreach($users as $user):?>
                    <li class="collection-item"><?php echo $user['email']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>
