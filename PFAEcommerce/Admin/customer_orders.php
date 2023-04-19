<?php session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
    if(time()-$_SESSION['LAT']>3600) header('location:déconnexion.php');
  }
 require 'Connexion2.php'
?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
    <div class="row">

        <?php include "./templates/sidebar.php"; ?>

        <div class="row">
            <div class="col-10">
                <h2>Customers</h2>
            </div>
        </div>
        <?php
      $query = "SELECT * FROM `bondecommande`";
      $result = mysqli_query($connexion2, $query);
      if (!$result) {
        die("error in query");
      }
      ?>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Num-article</th>
                        <th>Num-clt</th>
                        
                        <th>Date-cde</th>
                        <th>Quantité-cdé</th>
                        
                    </tr>
                </thead>
                <tbody id="customer_order_list">
                    <?php while ($com = mysqli_fetch_array($result)) { ?>

                        <tr>
                            <td>
                                <?php echo $com['Numcde']; ?>
                            </td>
                            <td>
                                <?php echo $com['Numarticle']; ?>
                            </td>
                            <td>
                                <?php echo $com['Numclt']; ?>
                            </td>
                          
                            
                            <td>
                                <?php echo $com['Date']; ?>
                            </td>
                            <td>
                                <?php echo $com['Quantité']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </main>
    </div>
</div>