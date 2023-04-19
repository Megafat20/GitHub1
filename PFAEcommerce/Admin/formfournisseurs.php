<?php include "./templates/top.php"; ?>

<?php include "./templates/navbar.php"; ?>

<div class="container">
	<div class="row justify-content-center" style="margin:100px 0;">
		<div class="col-md-4">
			<h4 class="text-center">Fournisseurs Registration</h4>
			<p class="message"></p>
			<form id="admin-register-form" action="Addfournisseurs.php" method="post">
			  <div class="form-group">
			    <label for="name">Full Name</label>
			    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
			  </div>
			  <div class="form-group">
			    <label for="Adress">Address</label>
			    <input type="text" class="form-control" name="Adresse" id="Adresse" placeholder="Enter email">
			    
			  </div>
			  <div class="form-group">
			    <label for="tel">Téléphone</label>
			    <input type="number" class="form-control" name="tel" id="tel" placeholder="Password">
			  </div>
			 
			 <button class="btn btn-primary register-btn"> <input type="submit" name="add-fournisseur" value="Add fournisseur"></button>
		
			</form>
		</div>
	</div>
</div>
