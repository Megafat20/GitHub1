<?php require 'Connexion2.php';
?>

<?php session_start();
if (!isset($_SESSION['admin_id'])) {
  header("location:index.php");
  if(time()-$_SESSION['LAT']>3600) header('location:déconnexion.php');
}
include_once("./templates/top.php");
include_once("./templates/navbar.php");
?>
<div class="container-fluid">
  <div class="row">


    <body>
      <style>
        body {
          background-image: url('Background.jpg');
          background-repeat: no-repeat;
          background-size: cover;
          background-attachment: fixed
        }
      </style>
      <?php
      $query = "SELECT * FROM `fournisseurs`";
      $result = mysqli_query($connexion2, $query);
      if (!$result) {
        die("error in query");
      }
      ?>

      <div class="container-fluid">
        <div class="row">

          <?php include "./templates/sidebar.php"; ?>

          <div class="row">
            <div class="col-10">
              <h2>Fournisseurs</h2>
            </div>
            <div class="col-2">
              <a href="Inscription.php"  class="btn btn-warning btn-sm">Add Fournisseurs</a>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>

                <th>Nom-fournisseur</th>
                <th>Adresse fournisseur</th>
                <th>téléphone</th>
                <th>Action </th>

                <?php
                while ($prod = mysqli_fetch_array($result)) { ?>

                  <tr>
                    <td>
                      <?php echo $prod['Nom_fournisseur']; ?>
                    </td>
                    <td>
                      <?php echo $prod['Adresse_fournisseur']; ?>
                    </td>
                    <td>
                      <?php echo $prod['téléphone']; ?>
                    </td>
                    <td> <button class='btn'> <a href="catalogues.php?id=<?php echo $prod[0]; ?>"> Afficher Catalogue</button>
                      <a href="deletefournisseur.php?id=<?php echo $prod[0]; ?>"> <img src="../Image/delete.png" width=20 height=20></a>
                      <a href="editfournisseur.php?id=<?php echo $prod[0]; ?>"> <img src="../Image/Update.jpg" width=20 height=20></a>
                    </td>


                  </tr>
              </thead>


            <?php } ?>
            <?php include('./templates/footer.php') ?>
            </table>

          </div>
        </div>