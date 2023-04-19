<?php
require 'Connexion2.php';

$name = $_POST['name'];
$price = $_POST['Price'];
$description = $_POST['description'];
$liste = $_POST['fournisseur'];
$quantite = $_POST['quantite'];
$mensuel = $_POST['mensuel'];
if (empty($name) || empty($price) || empty($image) || empty($description) || empty($liste) || empty($quantité) || empty($mensuel)) {
    $message[] = 'Remplissez toutes les informations';
}
if ($_FILES['image']['size'] > 1000000)
    echo "File size probleme, the max size allowed is 100000 bytes <a href='formprod.php'>Back</a>";
else {
    //the size is good

    if ($_FILES['image']['type'] != 'image/jpeg' and $_FILES['image']['type'] != 'image/jpg')
        echo "File type probleme, the type allowed is jpeg or jpg <a href='formprod.php'>Back</a>";
    else {
        $id = uniqid();
        move_uploaded_file($_FILES['image']['tmp_name'], "../Image/$id.jpeg");

        $query = "INSERT into articles values(null,'$name','$price','$id','$liste','$description','$quantite','$mensuel')";
        mysqli_query($connexion2, $query);
        echo 'New product added successfuly';
    }
};

header("location:products.php");
