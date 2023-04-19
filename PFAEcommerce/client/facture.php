<?php
session_start();
if (!isset($_SESSION["uid"])) {
    header("location:accueil.php");
}



require "config/Connexion.php";

$sql = "SELECT Numarticle,qty FROM choix WHERE Numclt = '$_SESSION[uid]'";
$query = mysqli_query($connexion, $sql);
if (mysqli_num_rows($query) > 0) {
   # code...
   while ($row = mysqli_fetch_array($query)) {
      $product_id[] = $row["Numarticle"];
      $qty[] = $row["qty"];
   }

   for ($i = 0; $i < count($product_id); $i++) {
      $sql = "INSERT INTO bondecommande VALUES (null,'" . $product_id[$i] . "','".$_SESSION['uid']."','" . date('d M Y') . "','" . $qty[$i] . "','Completed',0)";
     
      mysqli_query($connexion, $sql);
   }
}
   



$sql = "DELETE FROM choix WHERE Numclt = '$_SESSION[uid]'";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ecommerce</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <style>
        table tr td {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">Ecommerce</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
                <li><a href="profile.php"><span class="glyphicon glyphicon-modal-window"></span>Product</a></li>
                <li><a href="Contact.php">CONTACT & Help</a></li>
            </ul>
        </div>
    </div>
    <p><br /></p>
    <p><br /></p>
    <p><br /></p>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <h1>Facture </h1>
                        <hr />
                        <p>Hello <?php echo "<b>" . $_SESSION["name"] . "</b>"; ?>,Your products will be deliver in the week<br>
                            Check your bill<b></b><br />




                            <?php if (isset($_SESSION["uid"])) {


                                //When user is logged in this query will execute
                                $sql = "SELECT articles.Numarticle,articles.Désignation,articles.prix,articles.image,choix.id,choix.qty FROM articles,choix WHERE articles.Numarticle=choix.Numarticle AND choix.Numclt='$_SESSION[uid]'";
                            }
                            $query = mysqli_query($connexion, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                echo "<form method='post' action='addfacture.php'>"; ?>
                        <table class="table table-striped-columns">
                            <?php 
                            $n = 0;
                                while ($row = mysqli_fetch_array($query)) {
                                    $n++;
                            ?>





                               
                                <th><b>Product Image</b></th>
                                <th><b>Product Name</b></th>
                                <th><b>Quantity</b></th>
                                <th><b>Product Price</b></th>
                                <th><b>Price in <?php echo CURRENCY; ?></b></th>

                                <tr>
                            
                                    <input type="hidden" name="product" value="<?php echo $row["Numarticle"]; ?>" />
                                    <input type="hidden" name="" value="<?php echo $row['id']; ?>" />
                                  
                                    <td><img class="img-responsive" name="image" src="../Image/<?php echo $row["image"]; ?>.jpeg"></td>
                                    <td><input type="text" class=form-control name=des value="<?php echo $row["Désignation"]; ?>" readonly="readonly"></td>
                                    <td><input type="text" class="form-control qty" name=qty value="<?php echo $row["qty"]; ?>"></td>
                                    <td><input type="text" class="form-control price" name="price" value="<?php echo $row["prix"]; ?>" readonly="readonly"></td>
                                    <td><input type="text" class="form-control total" name="prix" value="<?php echo $row["prix"]; ?>" readonly="readonly"></td>
                                </tr>
                    </div>


                <?php
                                } ?>

                </table>
                <?php
                                echo '<div class="row">
						<div class="col-md-8"></div>
						<div class="col-md-4">
							<b class="net_total"  style="font-size:20px;"> </b>
				</div>';
                                if (isset($_SESSION["uid"])) {
                                    echo '<input type="submit" style="float:right;" name="login_user_with_product" class="btn btn-info btn-lg" value="Payement à la livraison" >;
							        
                                    <input style="float:right;margin-right:80px;" type="image" name="submit"
                                    src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypalcheckout-60px.png" alt="PayPal Checkout"
                                    alt="PayPal - The safer, easier way to pay online">
                            </form>';
                                } else {
                                    echo 'Connecter vous avant de passer à l achat ';
                ?><a href="login_form.php" style="float:right;" class="btn btn-info btn-lg">Connexion</a>
            <?php }
                            }
            ?>


                </div>
            </div>

        </div>
        <div class="panel-footer">
        </div>
        <script>
            var CURRENCY = '<?php echo CURRENCY; ?>';
        </script>
        ?>