 <nav class="navbar navbar-dark fixed-top  flex-md-nowrap p-0 shadow">
 	<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Ecommerce Site</a>
 	<input class="form-control " type="text" placeholder="Search" aria-label="Search">
 	<ul class="navbar-nav px-3">
 		<li class="nav-item text-nowrap">
 			<?php
				if (!isset($_SESSION['login'])) {
				?>
 				<button class="btn" style="color: black;"> <a href="déconnexion.php"> Sign out </button>
 				<?php
				} else {
					$uriAr = explode("/", $_SERVER['REQUEST_URI']);
					$page = end($uriAr);
					if ($page === "login.php") {
					?>
 					<a class="nav-link" href="../Admin/Inscription.php">Register</a>
 				<?php
					} else {
					?>
 					<a class="nav-link" style="color: black;" href="../Admin/index.php">Login</a>
 			<?php
					}
				}

				?>

 		</li>
 	</ul>
 </nav>