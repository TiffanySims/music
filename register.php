<?php

	include("includes/config.php");
	include("includes/classes/const.php");
	include("includes/classes/account.php");
			$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");
	

	function getInputValue($name){
		if(isset($_POST[$name])){
			echo $_POST[$name];
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Slotify</title>
	<link rel ="stylesheet"href="assets/css/log.css">
	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="assets/js/register.js"></script>
 
</head>

<body>
	<?php
	if(isset($_POST['registerButton'])){
		echo '<script> 
  				$(document).ready(function(){
	
				$("#loginForm").hide();
				$("#registerForm").show();
			});

 		 </script>';
	}
	else {
		echo'<script> 
  	$(document).ready(function(){
	
		$("#loginForm").show();
		$("#registerForm").hide();
	});

  </script>';
	}



	?>

	 
	<div id="background">
	<div id="loginContainer">

	<div id=inputContainer>
		<h1 class="heading">Get Music Now</h1>
		<form id="loginForm" action ="register.php" method="POST">
		
			<h2>Login to your account</h2>
			<p>	

			<?php echo $account -> getError(constants::$loginFailed) ?>
			<label for ="loginUsername">Username</label>
			<input id ="loginUsername" name="loginUsername" type="text" value="<?php getInputValue('loginUsername') ?>" placeholder="Guest" required >
			</p>

			<p>
			<label for ="loginPassword">Password</label>
			<input id ="loginPassword" name="loginPassword" type="password" placeholder="Password"  required>
			</p>

			<button type="submit" name="loginButton">LOG IN</button>
			<div class ="hasAccountText"><span id="hideLogin">Don't have an account yet? Signup here.</span>
			</div>


			

		</form>




		<form id="registerForm" action ="register.php" method="POST">
			<h2>Create your free account</h2>

			<p>	
			<?php echo $account -> getError(constants::$userNameLength) ?>
			<?php echo $account -> getError(constants::$usernameTaken) ?>

			<label for ="username">Username</label>
			<input id ="username" name="username" type="text" required value="<?php getInputValue('username') ?>"> 
			</p>

			<p>	
			<?php echo $account -> getError(constants::$firstNameLength) ?>
			<label for ="firstName">First Name</label>
			<input id ="firstName" name="firstName" type="text" required value="<?php getInputValue('firstName') ?>">
			</p>

			<p>	
			<?php echo $account -> getError(constants::$lastNameLength); ?>
			<label for ="lastName">Last Name</label>
			<input id ="lastName" name="lastName" type="text" required value="<?php getInputValue('lastName') ?>">
			</p>

			<p>	
			<?php echo $account -> getError(constants::$emailsDoNotMatch); ?>
			<?php echo $account -> getError(constants::$emailInvalid); ?>
			<?php echo $account -> getError(constants::$emailTaken); ?>


			<label for ="email">Email</label>
			<input id ="email" name="email" type="email" required value="<?php getInputValue('email') ?>">
			</p>

			<p>	
			
			<label for ="email2">Confirm Email</label>
			<input id ="email2" name="email2" type="email" required value="<?php getInputValue('email2') ?>">
			</p>

			<p>

			<?php echo $account -> getError(constants::$passwordsDoNotMatch); ?>
			<?php echo $account -> getError(constants::$passwordAlpha); ?>
			<?php echo $account -> getError(constants::$passwordLength); ?>

			<label for ="password">Password</label>
			<input id ="password" name="password" type="password"  required>
			</p>

			<p>
			<label for ="password2">Confirm Password</label>
			<input id ="password2" name="password2" type="password"  required>
			</p>

			<button type="submit" name="registerButton">SIGN UP</button>
			<div class ="hasAccountText"><span id="hideRegister">Already have an account? Login here.</span>
			</div>

		</form>
		
	</div>
	<div id="loginText">
		

		<h1 class="heading">Get great music, right now</h1>
		<h2>Listen to loads of music for free</h2>
		<ul>
			<li>Discover music you'll fall in live with</li>
			<li>Be the first to hear new releases</li>
			<li>Follow your favorite artists</li>

		</ul>



	</div>
	</div>

</div>


</body>
</html>