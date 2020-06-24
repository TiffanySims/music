<div id="navBarContainer">
				<nav class="navBar">

					<span  class="logo" onclick="openPage('index.php')">
						<img src="assets/images/logo.png">
					</span>
					<div class="navItem">
							<span class="name"><?php echo $userLoggedIn->getFirstLastName(); ?></span>
						</div>



					<div class="group">

						<div class="navItem">
							<span  onclick="openPage('browse.php')"class="navItemLink">Browse</span>
						</div>

						<div class="navItem">
							<span class="navItemLink" onclick="logout()"> Logout </span>
						</div>

					

						
					</div>




				</nav>
			</div>


	