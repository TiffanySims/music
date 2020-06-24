<?php
	class Account {

		private $errorArray;
		private $con;

		public function __construct($con) {
			$this -> con = $con;
			$this -> errorArray = array(); // set errorArray to array
		}

		public function login($un,$pw) {
			$pw=md5($pw);
			$query = mysqli_query($this ->con, "SELECT * FROM users WHERE username ='$un' AND password ='$pw'");
			if(mysqli_num_rows($query) == 1){
				return true;
			}
			else {
				array_push($this -> errorArray,constants::$loginFailed);
				return false;
			}
		}

		public function register($un,$fn,$ln,$em,$em2,$pw,$pw2) {
			$this -> validateUsername($un);
			$this -> validateFirstName($fn);
			$this -> validateLastName($ln);
			$this -> validateEmail($em,$em2);
			$this -> validatePassword($pw,$pw2);
			if(empty($this -> errorArray))
			{ //if no errors insert into database
				return $this -> insertUserDetails($un,$fn,$ln,$em,$pw);

			}
			else {
				return false;
			}

		}
		public function getError($error) {
			if(!in_array($error, $this->errorArray)) {
				$error="";
			}
			return "<span class='errorMessage'>$error</span>";
		}



		private function insertUserDetails($un,$fn,$ln,$em,$pw){
			$encryptedpw=md5($pw);
			$profilePic = 'assets/images/profile_pics/head-carrot.png';
			$date=date("Y-m-d");
			$result = mysqli_query($this -> con, "INSERT INTO users VALUES('','$un','$fn','$ln','$em','$encryptedpw','$date', '$profilePic')");
			return $result;
		}

		
		private function validateUsername($un) {
			if(strlen($un) > 25 || strlen($un) < 5) {
				array_push($this -> errorArray, constants::$userNameLength);
				return;
				

			}
		$checkUsernameQuery=mysqli_query($this -> con, "SELECT username FROM users WHERE username ='$un'");
				if(mysqli_num_rows($checkUsernameQuery)!=0){
					array_push($this -> errorArray, constants::$usernameTaken);
					return;
				
			}
		}
		private function validateFirstName($fn) {
			if(strlen($fn) > 25 || strlen($fn) < 2) {
				array_push($this -> errorArray, constants::$firstNameLength);
				return;

			}

		}

		private function validateLastName($ln) {
			if(strlen($ln) > 25 || strlen($ln) < 2) {
				array_push($this -> errorArray, constants::$lastNameLength);
				return;

			}

		}



		private function validateEmail($em,$em2) {
			
			if($em !=$em2) {
				array_push($this -> errorArray, constants::$emailsDoNotMatch);
				return;
			}

			if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this -> errorArray, constants::$emailInvalid);
				return;
			}

			$checkEmailQuery=mysqli_query($this -> con, "SELECT email FROM users WHERE email='$em'");
				if(mysqli_num_rows($checkEmailQuery)!=0) {
					array_push($this -> errorArray, constants::$emailTaken);
				}
		}


		private function validatePassword($pw,$pw2) {
			if($pw != $pw2) {
				array_push($this -> errorArray, constants::$passwordsDoNotMatch);
				return;

		}
			if(preg_match('/[^A-Za-z0-9]/', $pw)) {
				array_push($this -> errorArray, constants::$passwordAlpha );
				return;
			}

			if(strlen($pw) > 30 || strlen($pw) < 8) {
				array_push($this -> errorArray, constants::$passwordLength);
				return;

			}

		}
		

		




	}



?>