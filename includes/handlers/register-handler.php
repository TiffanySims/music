<?php

function sanitizeFormUsername($inputText){

	$inputText = strip_tags($inputText); // html tags
	$inputText = str_replace(" ","",$inputText); // no spaces
	return $inputText;
}

function sanitizeFormString($inputText){

	$inputText = strip_tags($inputText); // html tags
	$inputText = str_replace(" ","",$inputText); // no spaces
	$inputText = ucfirst(strtolower($inputText)); // convert to lower then uppercase first letter
	return $inputText;
}

function sanitizeFormPassword($inputText){

	$inputText = strip_tags($inputText); // html tags
	
	return $inputText;
}




if(isset($_POST['registerButton'])){
	//Register button was pressed
	$username = sanitizeFormUsername($_POST['username']);
	$firstName = sanitizeFormString($_POST['firstName']);
	$lastName = sanitizeFormString($_POST['lastName']);
	$email = sanitizeFormString($_POST['email']);
	$email2 = sanitizeFormString($_POST['email2']);
	$password = sanitizeFormPassword($_POST['password']);
	$password2 = sanitizeFormPassword($_POST['password2']);

	$wasSuccessful=$account -> register($username,$firstName,$lastName,$email,$email2,$password,$password2);

	if($wasSuccessful) {
	   $_SESSION['userLoggedIn']=$username;

		header("Location:index.php");
	}

}



?>

