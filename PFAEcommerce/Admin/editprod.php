 <?php


	require 'Connexion2.php';
	$num = $_GET['id'];
	$query = "SELECT * FROM articles
		WHERE Numarticle=$num";
	$result = mysqli_query($connexion2, $query);
	if ($result) {

		$prod = mysqli_fetch_array($result);
	}
	?>
 <?php include "./templates/top.php"; ?>

 <?php include "./templates/navbar.php"; ?>


 <div class="container">
 	<div class="row justify-content-center" style="margin:100px 0;">
 		<div class="col-md-4">

 			<form id="add-product-form" action=" updprod.php" method="post" enctype="multipart/form-data">
 				<div class="row">
 					<div class="col-12">
 						<div class="form-group">
 							<label for="Numarticle">Numarticle</label>
 							<input type="text" class="form-control" name="Numarticle" readonly value="<?php echo $prod['Numarticle']; ?>">
 						</div>
 					</div>
 					<div class="col-12">
 						<div class="form-group">
 							<label for="name">Désignation</label>
 							<input type="text" class="form-control" name="name" id="name" value="<?php echo $prod['Désignation']; ?>" placeholder="Enter Name">
 						</div>
 					</div>
 					<div class="col-12">
 						<div class="form-group">
 							<label for="Price">Prix</label>
 							<input type="number" class="form-control" name="Price" id="Price" value="<?php echo $prod['prix']; ?>" placeholder="Enter price">

 						</div>
 					</div>

 					<div class="col-12">
 						<div class="form-group">
 							<label for="fournisseur">Fournisseur</label><br>
 							<select name="fournisseur" ass="form-control">

 								<?php
									$query = "SELECT * FROM fournisseurs";
									$result = mysqli_query($connexion2, $query);
									while ($fournisseur = mysqli_fetch_row($result)) {
										echo "<option value='$fournisseur[0]'";
										echo $fournisseur[0];
										if ($fournisseur[0] == $prod[6])    echo " selected";
										echo ">$fournisseur[1]</option>";
									}
									?>
 						</div>
 					</div>

 					<div class="col-12">
 						<div class="form-group">
 							<label for="description">Description</label><br>
 							<textarea class="form-control" name="description" id="description" placeholder="Décrivez"><?php echo $prod['description']; ?>"</textarea>
 						</div>
 					</div>
 					<div class="col-12">
 						<div class="form-group">
 							<label for="Quantité">Quantité</label>
 							<input type="number" class="form-control" name="quantite" value="<?php echo $prod['Quantité']; ?>" id="quantite">
 						</div>
 					</div>
 					<div class="col-12">
 						<div class="form-group">
 							<label for="mensuel">Mensuel</label>
 							<input type="Date" class="form-control" name="mensuel" value="<?php echo $prod['mensuel']; ?>" id="Mensuel">
 						</div>
 					</div>




 					<input type="hidden" name="add_product" value="1">
 					<div class="col-12">
 						<button type="button" class="btn btn-primary add-product"> <input type="submit" Name="valider" value="Add modification" onclick="return verif()"></button>
 					</div>

 				</div>

 			</form>

 		</div>
 	</div>
 </div>
 <?php include_once("./templates/footer.php"); ?>



 <script type="text/javascript" src="./js/main.js"></script>