<?php include "./templates/top.php"; ?>

<?php include "./templates/navbar.php"; ?>

<div class="container">
	<div class="row justify-content-center" style="margin:100px 0;">
		<div class="col-md-4">
			<h4 class="text-center">Fournisseurs Registration</h4>
			<p class="message"></p>
			<form action="Addfournisseurs.php" method="POST">
				<div class="form-group">
					<label for="name">Full Name</label>
					<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
				</div>
				<div class="form-group">
					<label for="Adresse">Adresse</label>
					<textarea class="form-control" name="Adresse" placeholder="Enter login"></textarea>

				</div>
				<div class="form-group">
					<label for="Tel">Téléphone</label>
					<input type="text" class="form-control" name="Tel" placeholder="Password">
				</div>

				<input type="hidden" name="admin_register" value="1">
				<button  class="btn btn-primary register-btn"><a href="Addfournisseurs.php">Register</a></button>
			</form>
		</div>
	</div>
</div>



<?php include "./templates/footer.php"; ?>

<script type="text/javascript" src="./js/main.js"></script>