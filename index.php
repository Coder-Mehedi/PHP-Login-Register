<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard Page</title>
</head>
<body>
	<?php if(isset($_SESSION['email'])): ?>
	<h3>You are logged in as: <?php echo $_SESSION['email']; ?></h3>
	<a href="logout.php">Logout</a>
	<?php else: ?>
		<h3>Now you are logged out <a href="login.php">Go to login page</a></h3>
	<?php endif ?>
</body>
</html>