<?php
require 'Connexion2.php';
$num=$_POST['Numarticle'];
$name = $_POST['name'];
$price = $_POST['Price'];
$description = $_POST['description'];
$liste = $_POST['fournisseur'];
$quantite = $_POST['quantite'];
$mensuel = $_POST['mensuel'];


$query = " UPDATE articles SET Désignation ='$name',description='$description',Numfournisseur='$liste',prix='$price',Quantité='$quantite',mensuel='$mensuel' WHERE Numarticle=$num";
echo $query;
$result = mysqli_query($connexion2, $query);
header("location:products.php");
