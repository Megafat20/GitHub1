<?php
//require "config/constants.php";

session_start();
if(!isset($_SESSION["uid"])){
	header("location:accueil.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ecommerce</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<link rel="stylesheet" type="text/css" href="style2.css">
		<style>
			table tr td {padding:10px;}
		</style>
	</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<a href="#" class="navbar-brand">Ecommerce</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="accueil.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
				<li><a href="product.php"><span class="glyphicon glyphicon-modal-window"></span>Product</a></li>
		        <li><a href="Contact.php">CONTACT</a></li>
			</ul>
		</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
	
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<h1>Customer Order details</h1>
						<hr/>
						<?php
						require "config/Connexion.php";
					
							$user_id = $_SESSION["uid"];
							$orders_list = "SELECT bondecommande.Numcde,bondecommande.Numclt,bondecommande.Numarticle,bondecommande.Quantité,articles.prix,articles.image,articles.Désignation FROM bondecommande,articles WHERE bondecommande.Numclt='$user_id' AND bondecommande.Numarticle=articles.Numarticle";
							$query = mysqli_query($connexion,$orders_list);
							if (mysqli_num_rows($query) > 0) {
								while ($row=mysqli_fetch_array($query)) {
									?>
										<div class="row">
											<div class="col-md-6">
												<img style="float:right;" src="../Image/<?php echo $row['image']; ?>.jpeg" class="img-responsive img-thumbnail" width="300" height="300">
											</div>
											<div class="col-md-6">
												<table>
													<tr><td>Product Name</td><td><b><?php echo $row["Désignation"]; ?></b> </td></tr>
													<tr><td>Product Price</td><td><b><?php echo  CURRENCY." ".$row["prix"]; ?></b></td></tr>
													<tr><td>Quantity</td><td><b><?php echo $row["Quantité"]; ?></b></td></tr>
										            <tr><?php date('d M Y')?></tr>
												</table>
											</div>
										</div>
									<?php
								}
							}
						?>
						
					</div>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>
















































