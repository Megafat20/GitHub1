<?php
require 'Connexion2.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
    if(time()-$_SESSION['LAT']>3600) header('location:déconnexion.php');
  }
include 'templates/navbar.php';
include 'templates/sidebar.php';
include 'templates/top.php';

$num = $_GET['id'];
$query = "SELECT * FROM articles WHERE Numfournisseur='$num'";
$result = mysqli_query($connexion2, $query);



?>
<h1> Catalogue list </h1>
<div class="row">
    <div class="col-10">
        <h2>Fournisseurs</h2>
    </div>
    <div class="col-2">
        <a href="formprod.php" data-toggle="modal" data-target="#add_product_modal" class="btn btn-warning btn-sm">Add articles</a>
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
            <th>Action </th>
            <?php
            while ($prod = mysqli_fetch_array($result)) { ?>
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
                        <img src="../Image/<?php echo $prod['image']; ?>.jpeg" width=30 height=30>
                    </td>
                    <td> <a href="delprod.php?id=<?php echo $prod[0]; ?>"> <img src="../Image/delete.png" width=20 height=20></a>
                        <a href="editprod.php?id=<?php echo $prod[0]; ?>"> <img src="../Image/Update.jpg" width=20 height=20></a>
                    </td>


                </tr>
        </thead>


    <?php } ?>
    </table>
   