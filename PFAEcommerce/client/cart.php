<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
require "config/Connexion.php";

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
	<link rel="stylesheet" type="text/css" href="style2.css" />

</head>

<body>
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
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="cart_msg">
				<!--Cart Message-->
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Cart Checkout</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-2 col-xs-2"><b>Action</b></div>
							<div class="col-md-2 col-xs-2"><b>Product Image</b></div>
							<div class="col-md-2 col-xs-2"><b>Product Name</b></div>
							<div class="col-md-2 col-xs-2"><b>Quantity</b></div>
							<div class="col-md-2 col-xs-2"><b>Product Price</b></div>
							<div class="col-md-2 col-xs-2"><b>Price in <?php echo CURRENCY; ?></b></div>
						</div>

						<?php if (isset($_SESSION["uid"])) {


							//When user is logged in this query will execute
							$sql = "SELECT articles.Numarticle,articles.Désignation,articles.prix,articles.image,choix.id,choix.qty FROM articles,choix  WHERE articles.Numarticle=choix.Numarticle AND choix.Numclt='$_SESSION[uid]'";
						} else {
							//When user is not logged in this query will execute
							$sql = "SELECT articles.Numarticle,articles.Désignation,articles.prix,articles.image,choix.id,choix.qty FROM articles ,choix  WHERE articles.Numarticle=choix.Numarticle AND choix.Numclt  AND choix.ip_add='$ip_add' AND choix.Numclt < 0";
						}
						$query = mysqli_query($connexion, $sql);
						if (mysqli_num_rows($query) > 0) {
							echo "<form method='post' action='facture.php'>"; ?>

							<?php $n = 0;
							while ($row = mysqli_fetch_array($query)) {
								$n++;
							?>


								<div class="row">
									<div class="col-md-2">
										<div class="btn-group">
											<a href="#" remove_id=" <?php echo $row["Numarticle"]; ?>" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash"></span></a>
											<a href="#" update_id="<?php echo $row["Numarticle"]; ?>" class="btn btn-primary update"><span class="glyphicon glyphicon-ok-sign"></span></a>
										</div>
									</div>


									<form action="facture.php" method="POST">
										<input type="hidden" name="product" value="<?php echo $row["Numarticle"]; ?>" />
										<input type="hidden" name="" value="<?php echo $row['id']; ?>" />
										<div class="col-md-2"><img class="img-responsive" name="image" src="../Image/<?php echo $row["image"]; ?>.jpeg"></div>
										<div class="col-md-2"><input type="text" class=form-control name=des value="<?php echo $row["Désignation"]; ?>" readonly="readonly"></div>
										<div class="col-md-2"><input type="text" class="form-control qty" name=qty value="<?php echo $row["qty"]; ?>"></div>
										<div class="col-md-2"><input type="text" class="form-control price" value="<?php echo $row["prix"]; ?>" readonly="readonly"></div>
										<div class="col-md-2"><input type="text" class="form-control total" name="prix" value="<?php echo $row["prix"]; ?>" readonly="readonly"></div>

								</div>


							<?php
							} ?>


							<?php
							echo '<div class="row">
						<div class="col-md-8"></div>
						<div class="col-md-4">
							<b class="net_total" style="font-size:20px;"> </b>
				</div>';
							if (isset($_SESSION["uid"])) {
								echo '<input type="submit" style="float:right;" name="login_user_with_product" class="btn btn-info btn-lg" value="your bill here" >
							</form>';
							} else {

							?><a href="login_form.php" style="float:right;" class="btn btn-info btn-lg">Connexion</a>
						<?php }
						}
						if (isset($_POST["removeItemFromCart"])) {
							$remove_id = $_POST["rid"];
							if (isset($_SESSION["uid"])) {
								$sql = "DELETE FROM choix WHERE Numarticle = '$remove_id' AND Numclt = '$_SESSION[uid]'";
							}else {
								$sql = "DELETE FROM choix WHERE Numarticle = '$remove_id' AND ip_add = '$ip_add'";
							};
						
							if (mysqli_query($connexion, $sql)) {
								echo "<div class='alert alert-danger'>
												<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
												<b>Product is removed from cart</b>
										</div>";
								exit();
							}
						}
						
						
						//Update Item From cart
						if (isset($_POST["updateCartItem"])) {
							$update_id = $_POST["update_id"];
							$qty = $_POST["qty"];
							if (isset($_SESSION["uid"])) {
								$sql = "UPDATE choix SET qty='$qty' WHERE Numarticle = '$update_id' AND Numclt = '$_SESSION[uid]'";
							}else {
								$sql = "UPDATE choix SET qty='$qty' WHERE Numarticle = '$update_id' AND ip_add = '$ip_add'";
							};
						
							if (mysqli_query($connexion, $sql)) {
								echo "<div class='alert alert-info'>
												<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
												<b>Product is updated</b>
										</div>";
								exit();
							}
						}
						
						
						?>


					</div>
				</div>

			</div>

		</div>


		<script>
			var CURRENCY = '<?php echo CURRENCY; ?>';
		</script>
		<!-- 	
	<div class="panel-footer">
	</div> -->
</body>

</html>