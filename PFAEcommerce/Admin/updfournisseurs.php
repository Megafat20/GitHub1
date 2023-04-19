<?php
   require "Connexion2.php";
    $num=$_POST['Numfournisseur'];
    $name=$_POST['name'];
    $Adresse=$_POST['Adresse'];
    $tel=$_POST['Tel'];


$query = " UPDATE fournisseurs SET Nom_fournisseur ='$name', Adresse_fournisseur='$Adresse', téléphone=$tel WHERE Numfournisseur=$num";
$result = mysqli_query($connexion2, $query);
header("location:allfournisseurs.php");
