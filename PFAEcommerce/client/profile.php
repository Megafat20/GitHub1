<?php
require "config/Connexion.php";
session_start();
if(time()-$_SESSION['LAT']>3600)  header('location:logout.php');
if (!isset($_SESSION["uid"])) {
	header("location:accueil.php");
}
if (isset($_POST["login_user_with_product"])) {
	//this is product list array
	$product_list = $_POST["product_id"];
	//here we are converting array into json format because array cannot be store in cookie
	$json_e = json_encode($product_list);
	//here we are creating cookie and name of cookie is product_list
	setcookie("product_list", $json_e, strtotime("+1 day"), "/", "", "", TRUE);
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Ecommerce</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />

	<script src="js/jquery2.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="main.js"></script>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<!-- CSS only -->
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
	<!-- JavaScript Bundle with Popper -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> -->
</head>

<body>
	<div class="wait overlay">
		<div class="loader"></div>
	</div>

	<div class="body">
		<div class="navbare">
			<div class="icone">
				<h2 class="logo">Fast In Shop</h2>

			</div>
			<div class="menue">
				<ul>
					<li><a href="accueil.php">HOME</a></li>
					<li><a href="product.php">Product</a></li>
					<li><a href="Contact.php">CONTACT </a></li>
				</ul>
			</div>
			<div class="search">
				<input class="srch" type="search" name="" placeholder="Type to search">
				<a href="#"><button class="btnn">search</button></a>

			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge">0</span></a>
					<div class="dropdown-menu" style="width:300px; ">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-3">Sl.No</div>
									<div class="col-md-3">Product Image</div>
									<div class="col-md-3">Product Name</div>
									<div class="col-md-3">Price in Rs</div>
								</div>
							</div>
							<div class="panel-body">
								<div id="cart_product">
									<!--<div class="row">
									<div class="col-md-3">Sl.No</div>
									<div class="col-md-3">Product Image</div>
									<div class="col-md-3">Product Name</div>
									<div class="col-md-3">Price in $.</div>
								</div>-->
								</div>
							</div>
							<div class="panel-footer"></div>
						</div>
					</div>
				</li>
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo "Hi, " . $_SESSION["name"]; ?></a>
					<ul class="dropdown-menu">
						<li><a href="cart.php" style="text-decoration:none; color:black;"><span class="glyphicon glyphicon-shopping-cart"> Cart</a></li>
						<li class="divider"></li>
						<li><a href="customer_order.php" style="text-decoration:none; color:black;">Orders</a></li>
						<li class="divider"></li>

						<li><a href="logout.php" style="text-decoration:none; color:black;">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	</div>
	<p><br /></p>
	<p><br /></p>
	<p><br /></p>
	<div class="title">

		<h1> WELCOME TO THE SHOPPPPPP </h1>
	</div>
	</div>
	  <?php include 'slider.php' ?>
	
	<div class="intro">
        <h2>New product</h2>

	
	<p>Done your choice</p>
	</div>
	<div class="col-md-8 col-xs-12">
		<div class="row">
			<div class="col-md-12 col-xs-12" id="product_msg">
			</div>
		</div>
		<div class="zone panel-info">
			<div class="panel-heading">Products</div>
			<div class="panel-body">
				<div id="get_product">
					<!--Here we get product jquery Ajax Request-->
				</div>

			</div>

		</div>
	</div>
	<div class="col-md-1"></div>
	<?php

	?>
	</div>



	<script src="slider.js"></script>
</body>

</html>