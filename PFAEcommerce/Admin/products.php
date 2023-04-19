<html>

<head>
    <script language="javascript">
        function Agrandir() {
            document.getElementbyId('i').width == 500, height == 500

        }

        function Diminuer() {
            document.getElementbyId('i').width == 25, height = 25
        }

        function verif() {
            {

                if (document.getElementById('n').value == "") {
                    alert('The name is necessary');
                    return false;
                }
                if (document.getElementById('desc').value == "") {
                    alert('The description is necessary');
                    return false;
                }
                if (document.getElementById('P').value == "") {
                    alert('The price is necessary');
                    return false;
                }

                if (isNaN(document.getElementById('P').value)) {
                    alert('The price must be a number');
                    return false;
                }

                if (document.getElementById('P').value < 0) {
                    alert('The price can\'t be negatif');
                    return false;
                }
                if (document.getElementById('f').value == 0) {
                    alert('The fournisseur is necessary');
                    return false;
                }
                if (document.getElementById('i').value == 0) {
                    alert('The file is necessary');
                    return false;
                }
                if (document.getElementById('m').value == 0) {
                    alert('Date is necessary');
                    return false;
                }
                if (document.getElementById('q').value == 0) {
                    alert('Quantity please');
                    return false;
                }




            }
        }
    </script>
</head>

<?php
require "Connexion2.php";
$query = "SELECT * FROM articles";
$result = mysqli_query($connexion2, $query);
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
    if (time() - $_SESSION['LAT'] > 3600) header('location:déconnexion.php');
}
include "templates/top.php";
include "templates/navbar.php";
include "templates/sidebar.php";
?>

<style>
    body {
        background-image: url('Background.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed
    }
</style>

<div class="container-fluid">
    <div class="row">


        <div class="row">
            <div class="col-10">
                <h1>Product List</h1>
            </div>
            <div class="col-2">
                <a href="#" data-toggle="modal" data-target="#add_product_modal" class="btn btn-warning btn-sm">Add Product</a>
            </div>
        </div>






        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>

                    <th>Désignation</th>
                    <th>Prix</th>
                    <th>Numfournisseur</th>
                    <th>description</th>
                    <th>Quantité</th>
                    <th>Image</th>
                    <th>mensuel</th>
                    <th>Action </th>
                </thead>
                <tbody>

                    <?php while ($prod = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td>
                                <?php echo $prod['Désignation']; ?>
                            </td>
                            <td>
                                <?php echo $prod['prix']; ?>
                            </td>
                            <td>
                                <?php echo $prod['Numfournisseur']; ?>
                            </td>
                            <td>
                                <?php echo $prod['description']; ?>
                            </td>
                            <td>
                                <?php echo $prod['Quantité']; ?>
                            </td>

                            <td>
                                <img id='i' src="../Image/<?php echo $prod['image']; ?>.jpeg" onmouseover="Agrandir()" onmouseout="Diminuer()" name="i" widht=25 height=25>
                            </td>

                            <td>
                                <?php echo $prod['mensuel']; ?>
                            </td>

                            <td><a href="delprod.php?id=<?php echo $prod[0]; ?>"> <img src="../Image/delete.png" width=20 height=20></a> &nbsp;
                                <a href="editprod.php?id=<?php echo $prod[0]; ?>"> <img src="../Image/Update.jpg" width=20 height=20></a>
                            </td>


                        </tr>
                </tbody>


            <?php } ?>
            </table>
        </div>
    </div>
</div>

<!-- Add Product Modal start -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">





                <form id="add-product-form" onsubmit="verif()" action="addarticle.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Désignation</label>
                                <input type="text" class="form-control" name="name" id="n" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="Price">Prix</label>
                                <input type="number" class="form-control" name="Price" id="P" placeholder="Enter price">

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" name="image" id="i">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="fournisseur">Fournisseur</label>
                                <select name="fournisseur" id="f" class="form-control">
                                    <option value='0'>choisir ici</option>
                                    <?php

                                    $query = "SELECT * FROM fournisseurs";
                                    $result = mysqli_query($connexion2, $query);
                                    while ($cat = mysqli_fetch_row($result)) {
                                        echo "<option value='$cat[0]'>$cat[1]</option>";
                                    }

                                    ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="desc" placeholder="Décrivez"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="Quantité">Quantité</label>
                                <input type="number" class="form-control" name="quantite" id="q">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="mensuel">Mensuel</label>
                                <input type="Date" class="form-control" name="mensuel" id="M">
                            </div>
                        </div>




                        <input type="hidden" name="add_product" value="1">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary add-product"> <input type="submit" Name="valider" onclick="return verif()"></button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Product Form -->



<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/products.js"></script>

</html>