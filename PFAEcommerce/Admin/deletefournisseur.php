<?php

	require 'Connexion2.php';
	$num=$_GET['id'];
	$query="DELETE FROM fournisseurs WHERE Numfournisseur=$num";
	mysqli_query($connexion2, $query);
	header('location:allfournisseurs.php');
?>
