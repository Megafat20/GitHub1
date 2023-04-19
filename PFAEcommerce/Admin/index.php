<!DOCTYPE html>
<html>

<head>

	<title> Page d'acceuil</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="index.js"></script>
</head>

<body>
	<div class="body">
		<div class="navbar">
			<div class="icon">
				<h2 class="logo">ECOMMERCE</h2>

			</div>
		
			<div class="search">
				<input class="srch" type="search" name="" placeholder="Type to search">
				<a href="#"><button class="btn">search</button></a>

			</div>
		</div>
		<div class="content">
			<h1> WELCOME TO <br>OUR WEB SITE </h1>
			<p class="par"> <br><b> Un site attractif qui vous facilitera la vie.
					<br> Vous y trouverai de bons plans </b>
			</p>
			<button class="cn"><a href="#">JOIN US</a></button>
			<div class="form">
				<h2>login here</h2>
				<form id="admin-login-form" action="verifauth.php" method="POST">
					<label for="login">login</label>
					<input type="text" name="login" id="login" placeholder="veuillez entrer le login">
					<label for="pass">Password</label>
					<input type="password" name="pass" id="pass" placeholder="veuillez entrez le mot de pass">
					<input type="hidden" name="admin_login" value="1">
					<button class="btnn"><input type="submit" name="valider"></button>

				</form>
			</div>
		</div>
	</div>

</body>
<!-- <script type="text/javascript" src="../Admin/js/main.js"></script> -->

</html>