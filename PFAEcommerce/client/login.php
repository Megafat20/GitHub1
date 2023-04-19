<?php
require "config/Connexion.php";
session_start();


					

				
#Login script is begin here
#If user given credential matches successfully with the data available in database then we will echo string login_success
#login_success string will go back to called Anonymous funtion $("#login").click() 
if(isset($_POST["Email"]) && isset($_POST["password"])){
	$email = mysqli_real_escape_string($connexion,$_POST["Email"]);
	$password = md5($_POST["password"]);
	$sql = "SELECT * FROM client WHERE Email = '$email' AND password = '$password'";
	
	$run_query = mysqli_query($connexion,$sql);
	$count = mysqli_num_rows($run_query);
	//if user record is available in database then $count will be equal to 1
	if($count == 1){
		$row = mysqli_fetch_array($run_query);
		$_SESSION["uid"] = $row["Numclt"];
		$_SESSION["name"] = $row["Nom"];
		$_SESSION['LAT']=time();
		$ip_add = getenv("REMOTE_ADDR");
		//we have created a cookie in login_form.php page so if that cookie is available means user is not login
			if (isset($_COOKIE["product_list"])) {
				$p_list = stripcslashes($_COOKIE["product_list"]);
				//here we are decoding stored json product list cookie to normal array
				$product_list = json_decode($p_list,true);
				for ($i=0; $i < count($product_list); $i++) { 
					//After getting user id from database here we are checking user cart item if there is already product is listed or not
					$verify_cart = "SELECT id FROM choix WHERE Numclt = $_SESSION[uid] AND Numarticle = ".$product_list[$i];
					$result  = mysqli_query($connexion,$verify_cart);
					if(mysqli_num_rows($result) < 1){
						//if user is adding first time product into cart we will update user_id into database table with valid id
						$update_cart = "UPDATE choix SET Numclt = '$_SESSION[uid]' WHERE ip_add = '$ip_add' AND Numclt = -1";
						mysqli_query($connexion,$update_cart);
					}else{
						//if already that product is available into database table we will delete that record
						$delete_existing_product = "DELETE FROM choix WHERE Numclt = -1 AND ip_add = '$ip_add' AND Numarticle = ".$product_list[$i];
						mysqli_query($connexion,$delete_existing_product);
					}
				}
				//here we are destroying user cookie
				setcookie("product_list","",strtotime("-1 day"),"/");
				//if user is logging from after cart page we will send cart_login
				echo "cart_login";
				exit();
				
			}
			//if user is login from page we will send login_success
			echo "login_success";
			exit();
		}else{
			echo "<span style='color:red;'>Please register before login..!</span>";
			exit();
		}
	
}

