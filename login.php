<?php
   session_start();
  include("connnect.php");
  include("user.php");
  if(isset($_SESSION['userLoggedIn'])){
       header("Location: index.php");
  }

  $user = new user();
  include("loginhandle.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Viralpedia: Login</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/login.css" rel="stylesheet">


</head>
<body>

<h2>Welcome to our website</h2>

 <?php

      if( $user->getError() != null){
        echo'<div class="alert alert-danger" role="alert">'.$user->getError().'</div>';
      };

 ?>

<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="" method="POST">
			<h1>Create Account</h1>
			<input type="text" name="username" placeholder="Name" />
			<input type="email" name="email" placeholder="Email" />
			<input type="password" name="password" placeholder="Password" />
			<button type ="submit" name="Register">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="" method="POST">
			<h1>Sign in</h1>
			<input type="email" name="email" placeholder="Email" />
			<input type="password" name="password" placeholder="Password" />
			<a href="#">Forgot your password?</a>
			<button type ="submit" name="Login">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>



  <script src="assets/js/login.js"></script>

</body>
</html>  
