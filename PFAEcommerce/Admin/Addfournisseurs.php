
<?php
   require "Connexion2.php";

    $name=$_POST['name'];
    $Adresse=$_POST['Adresse'];
    $tel=$_POST['Tel'];
  
	
    $query="INSERT into fournisseurs values(null,'$name','$Adresse','$tel')";
    mysqli_query($connexion2,$query);
   header("location:allfournisseurs.php");
?>
