<?php
include("includes/config.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");
include("includes/classes/User.php");




if(isset($_SESSION['userLoggedIn'])) {
$userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
$username = $userLoggedIn->getUsername();
echo "<script>userLoggedIn = '$username'; </script>";
}
else {
	header("Location: register.php");
}

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet"href="assets/css/styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src='assets/js/script.js'></script>
</head>
<body>
	
	<div id="mainContainer">
		<div id="topContainer">

			<?php include("includes/navbarContainer.php"); ?>
			<div id="mainViewContainer">
				<div id="mainContent">