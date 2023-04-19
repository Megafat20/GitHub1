<?php


	require 'Connexion2.php';
	$num=$_GET['id'];
	$query="DELETE FROM articles WHERE Numarticle=$num";
	mysqli_query($connexion2, $query);
	header('location:products.php');
?>
