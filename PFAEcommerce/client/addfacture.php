<?php
session_start();
if (!isset($_SESSION["uid"])) {
   header("location:accueil.php");
}



require "config/Connexion.php";
if (isset($_GET["st"])) {

	# code...
	$trx_id = $_GET["tx"];
		$p_st = $_GET["st"];
		$amt = $_GET["amt"];
		$cc = $_GET["cc"];
		$cm_user_id = $_GET["cm"];
		$c_amt = $_COOKIE["ta"];
	if ($p_st == "Completed") {
$sql = "SELECT Numarticle,qty FROM choix WHERE Numclt = '$_SESSION[uid]'";
$query = mysqli_query($connexion, $sql);
if (mysqli_num_rows($query) > 0) {
   # code...
   while ($row = mysqli_fetch_array($query)) {
      $product_id[] = $row["Numarticle"];
      $qty[] = $row["qty"];
   }

   for ($i = 0; $i < count($product_id); $i++) {
      $sql = "INSERT INTO bondecommande VALUES (null,'" . $product_id[$i] . "','".$_SESSION['uid']."','" . date('d M Y') . "','" . $qty[$i] . "','Completed','$trx_id')";
     
      mysqli_query($connexion, $sql);
   }
}
    }
}

$prix=$_POST['prix'];
$s="SELECT Numcde,Numarticle FROM bondecommande WHERE Numclt = '$_SESSION[uid]'";
$query=mysqli_query($connexion,$s);

if (mysqli_num_rows($query) > 0) {
    # code...
    while ($row = mysqli_fetch_array($query)) {
       $product_id[] = $row["Numarticle"];
       $Numcde[] = $row["Numcde"];
    }
 
    for ($i = 0; $i < count($Numcde); $i++) {

      $sql = "INSERT INTO facture VALUES (null,'" . date('d M Y') . "','$prix','".$Numcde[$i]."',".$_SESSION['uid'].")";
    }
}
      mysqli_query($connexion, $sql);
      $sql1 = "DELETE FROM choix WHERE Numclt = '$_SESSION[uid]'";
      if (mysqli_query($connexion,$sql1)) {
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
                  <link rel="stylesheet" type="text/css" href="style2.css" />
                  <style>
                     table tr td {padding:10px;}
                  </style>
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
                   <li><a href="Contact&Help.php">CONTACT & Help</a></li>
               </ul>
           </div>
       </div>
               <div class="container-fluid">
               
                  <div class="row">
                     <div class="col-md-2"></div>
                     <div class="col-md-8">
                        <div class="panel panel-default">
                           <div class="panel-heading"></div>
                           <div class="panel-body">
                              <h1>Thankyou </h1>
                              <hr/>
                              <p>Hello <?php echo "<b>".$_SESSION["name"]."</b>"; ?>, Le livreur est en route payement à la livraison 
                           <br/>
                              </p>
                              <form action="profile.php" method="POST">
                              <input type="submit" class="btn btn-success btn-lg" value="Continue shop">
                              </form>
   
                           </div>
                           <div class="panel-footer"></div>
                        </div>
                     </div>
                     <div class="col-md-2"></div>
                  </div>
               </div>
            </body>
            </html>
   
         <?php
      }
   else{
      header("location:profile.php");
   }
   