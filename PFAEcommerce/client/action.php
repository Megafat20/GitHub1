<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "config/Connexion.php";


if (isset($_POST["getProduct"])) {
	

	 
	$product_query = "SELECT * FROM articles ";
	
	$run_query = mysqli_query($connexion, $product_query);
	if (mysqli_num_rows($run_query) > 0) {
		while ($row = mysqli_fetch_array($run_query)) {
			$pro_id    = $row['Numarticle'];
			$pro_title = $row['Désignation'];
			$pro_price = $row['prix'];
			$pro_image = $row['image'];

			echo "
				<div class='col-md-4'>
							<div class='info panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='style'>
									<img src='../Image/$pro_image.jpeg' style='width:200px; height:250px;' />
								</div>
								<div class='panel-heading'>$pro_price.00.MAD
									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Add To Cart</button>
								</div>
							</div>
						</div>	
			";
?>

		<?php
		}
	}
}

if (isset($_POST["addToCart"])) {

	$Numarticle = $_POST["proId"];


	if (isset($_SESSION["uid"])) {

		$Numclt = $_SESSION["uid"];


		$sql = "SELECT * FROM choix WHERE Numarticle = '$Numarticle' AND Numclt='$Numclt' ";
		$run_query = mysqli_query($connexion, $sql);
		$count = mysqli_num_rows($run_query);
		if ($count > 0) {
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is already added into the cart Continue Shopping..!</b>
				</div>
			"; //not in video
		} else {
			$sql = "INSERT INTO choix
		
			VALUES (null,'$Numarticle','$ip_add','$Numclt','1')";
			if (mysqli_query($connexion, $sql)) {
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is Added..!</b>
					</div>
				";
			}
		}
	} else {
		$sql = "SELECT id FROM choix WHERE ip_add = '$ip_add' AND Numarticle = '$Numarticle' AND Numclt =-1 ";
		$query = mysqli_query($connexion, $sql);
		if (mysqli_num_rows($query) > 0) {
			echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Product is already added into the cart Continue Shopping..!</b>
					</div>";
			exit();
		}
		$sql = "INSERT INTO choix
			
			VALUES (null,$Numarticle,'$ip_add',-1,1)";
         
		if (mysqli_query($connexion, $sql)) {
			echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Your product has been added to cart!</b>
					</div>
				";
			exit();
		}
	}
}

//Count User cart item
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT COUNT(*) AS count_item FROM choix WHERE Numclt = '$_SESSION[uid]'";
	} else {
		//When user is not logged in then we will count number of item in cart by using users unique ip address
		$sql = "SELECT COUNT(*) AS count_item FROM choix WHERE ip_add = '$ip_add' AND Numclt < 0";
	}
	$query = mysqli_query($connexion, $sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_item"];
	exit();
}

//Count User cart item

// Count User cart item

// Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {

	if (isset($_SESSION["uid"])) {
		//When user is logged in this query will execute
		$sql = "SELECT articles.Numarticle,articles.Désignation,articles.prix,articles.image,choix.id,choix.qty FROM articles,choix  WHERE articles.Numarticle=choix.Numarticle AND choix.Numclt='$_SESSION[uid]'";
	} else {
		//When user is not logged in this query will execute
		$sql = "SELECT articles.Numarticle,articles.Désignation,articles.prix,articles.image,choix.id,choix.qty FROM articles ,choix  WHERE articles.Numarticle=choix.Numarticle AND choix.Numclt  AND choix.ip_add='$ip_add' AND choix.Numclt < 0";
	}

	$query = mysqli_query($connexion, $sql);

	if (isset($_POST["getCartItem"])) {
		//display cart item in dropdown menu
		if (mysqli_num_rows($query) > 0) {
			$n = 0;
			while ($row = mysqli_fetch_array($query)) {
				$n++;
				$product_id = $row["Numarticle"];
				$product_title = $row["Désignation"];
				$product_price = $row["prix"];
				$product_image = $row["image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				echo '
					<div class="row">
						<div class="col-md-3">' . $n . '</div>
						<div class="col-md-3"><img class="img-responsive" src="../Image/' . $product_image . '.jpeg" /></div>
						<div class="col-md-3">' . $product_title . '</div>
						<div class="col-md-3">' . CURRENCY . '' . $product_price . '</div>
					</div>';
			}
		?>
			<a style="float:right;" href="cart.php" class="btn btn-warning">Edit&nbsp;&nbsp;<span class="glyphicon glyphicon-edit"></span></a>
	<?php
			exit();
		}
	}
	?>

<?php
	exit();


	// if (isset($_POST["checkOutDetails"])) {
	// 	if (mysqli_num_rows($query) > 0) {
	// 		//display user cart item with "Ready to checkout" button if user is not login

	// 		$n = 0;
	// 		while ($row = mysqli_fetch_array($query)) {
	// 			$n++;
	// 			$product_id = $row["Numarticle"];
	// 			$product_title = $row["Désignation"];
	// 			$product_price = $row["prix"];
	// 			$product_image = $row["image"];
	// 			$cart_item_id = $row["id"];
	// 			$qty = $row["qty"];

	// 			echo
	// 			'<div class="row">
	// 							<div class="col-md-2">
	// 								<div class="btn-group">
	// 									<a href="#" remove_id="' . $product_id . '" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash"></span></a>
	// 									<a href="#" update_id="' . $product_id . '" class="btn btn-primary update"><span class="glyphicon glyphicon-ok-sign"></span></a>
	// 								</div>
	// 							</div>
	// 							<input type="hidden" name="product_id[]" value="' . $product_id . '"/>
	                             
	// 							<div class="col-md-2"><img class="img-responsive" src="../Image/' . $product_image . '.jpeg"></div>
	// 							<div class="col-md-2">' . $product_title . '</div>
	// 							<div class="col-md-2"><input type="text" class="form-control qty" value="' . $qty . '" ></div>
	// 							<div class="col-md-2"><input type="text" class="form-control price" value="' . $product_price . '" readonly="readonly"></div>
	// 							<div class="col-md-2"><input type="text" class="form-control total" value="' . $product_price . '" readonly="readonly"></div>
	// 						</div>';
	// 		}

	// 		echo '<div class="row">
	// 						<div class="col-md-8"></div>
	// 						<div class="col-md-4">
	// 							<b class="net_total" style="font-size:20px;"> </b>
	// 				</div>';
	// 		if (!isset($_SESSION["uid"])) {
	// 			echo '<input type="submit" style="float:right;" name="login_user_with_product" class="btn btn-info btn-lg" value="Ready to Checkout" >
	// 					</form>';
	// 		} else if (isset($_SESSION["uid"])) {
	// 			//Paypal checkout form
	// 			echo '
	// 				</form>
	// 				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
	// 					<input type="hidden" name="cmd" value="_cart">
	// 					<input type="hidden" name="business" value="shoppingcart@ecommerceastro.com">
	// 					<input type="hidden" name="upload" value="1">';

	// 			$x = 0;
	// 			$sql = "SELECT articles.Numarticle,articles.Désignation,articles.prix,articles.image,choix.id,choix.qty FROM articles,choix  WHERE articles.Numarticle=choix.Numarticle AND choix.Numclt='$_SESSION[uid]'";
	// 			$query = mysqli_query($connexion, $sql);
	// 			while ($row = mysqli_fetch_array($query)) {
	// 				$x++;
	// 				echo
	// 				'<input type="hidden" name="item_name_' . $x . '" value="' . $row["product_title"] . '">
	// 						  	 <input type="hidden" name="item_number_' . $x . '" value="' . $x . '">
	// 						     <input type="hidden" name="amount_' . $x . '" value="' . $row["product_price"] . '">
	// 						     <input type="hidden" name="quantity_' . $x . '" value="' . $row["qty"] . '">';
	// 			}

	// 			echo
	// 			'<input type="hidden" name="return" value="http://localhost/project1/payment_success.php"/>
	// 			                <input type="hidden" name="notify_url" value="http://localhost/ecommerce-app-h/payment_success.php">
	// 							<input type="hidden" name="cancel_return" value="http://localhost/ecommerce-app-h/cancel.php"/>
	// 							<input type="hidden" name="currency_code" value="USD"/>
	// 							<input type="hidden" name="custom" value="' . $_SESSION["uid"] . '"/>
	// 							<input style="float:right;margin-right:80px;" type="image" name="submit"
	// 								src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypalcheckout-60px.png" alt="PayPal Checkout"
	// 								alt="PayPal - The safer, easier way to pay online">
	// 						</form>';
	// 		}
	// 	}
	// }
}

// Remove Item From cart



?>