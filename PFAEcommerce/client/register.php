<?php
session_start();
require "config/Connexion.php";
if (isset($_POST["f_name"])) {

	$Nom = $_POST["f_name"];
	$Prénom = $_POST["l_name"];
	$Email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$Téléphone = $_POST['mobile'];
	$Adresse = $_POST['address1'];
	$name = "/^[a-zA-Z ]+$/";
	$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
	$number = "/^[0-9]+$/";

if(empty($Nom) || empty($Prénom) || empty($Email)  ||empty($password)  ||empty($repassword)  ||
	empty($Téléphone) || empty($Adresse) ){
		
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
		exit();
	} else {
		if(!preg_match($name,$Nom)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $Nom is not valid..!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($name,$Prénom)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $l_name is not valid..!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($emailValidation,$Email)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $email is not valid..!</b>
			</div>
		";
		exit();
	}
	if(strlen($password) < 9 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
		exit();
	}
	if(strlen($repassword) < 9 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
		exit();
	}
	if($password != $repassword){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>password is not same</b>
			</div>
		";
	}
	if(!preg_match($number,$Téléphone)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number $mobile is not valid</b>
			</div>
		";
		exit();
	}
	
	//existing email address in our database
	$sql = "SELECT 'Numclt' FROM client WHERE 'E-mail' = '$Email' LIMIT 1" ;
	$check_query = mysqli_query($connexion,$sql);
	$count_email = mysqli_num_rows($check_query);
	if($count_email > 0){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Email Address is already available Try Another email address</b>
			</div>
		";
		exit();			

	} else {
		$password = md5($password);
		$sql = "INSERT INTO `client`  
		VALUES (NULL, '$Nom', '$Prénom', '$Téléphone', 
		'$Adresse', '$Email','$password')";
		$run_query = mysqli_query($connexion,$sql);
		$_SESSION["uid"] = mysqli_insert_id($connexion);
		$_SESSION["name"] = $Nom;
		
		
			echo "register_success";
			exit();
		}
	}
	}
	

