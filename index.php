<?php session_start(); ?>
<?php include 'templates/header.php'; ?>
<div class="center">
	
	<?php if(isset($_SESSION['email'])): ?>
	<h1>Hello and welcome!!!</h1>
	<h3>You are logged in as: <?php echo $_SESSION['email']; ?></h3>
	<a href="logout.php">Logout</a>
	<?php else: ?>
		<h3>Now you are logged out <a href="login.php">Go to login page</a></h3>
	<?php endif ?>
</div>
<?php include 'templates/footer.php' ?>