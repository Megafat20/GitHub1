<?php


require 'Connexion2.php';
$num = $_GET['id'];
$query = "SELECT * FROM fournisseurs
		WHERE Numfournisseur=$num";
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

            <form id="admin-register-form"" action=" updfournisseurs.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Numarticle">Numfournisseur</label>
                            <input type="text" class="form-control" name="Numfournisseur" readonly value="<?php echo $prod['Numfournisseur']; ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">FullName</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $prod['Nom_fournisseur']; ?>" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Price">Adresse</label>
                            <textarea class="form-control" name="Adresse"> <?php echo $prod['Adresse_fournisseur']; ?></textarea>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Tel">Téléphone</label>
                            <input type="text" class="form-control" name="Tel" value="<?php echo $prod['téléphone']; ?>">

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