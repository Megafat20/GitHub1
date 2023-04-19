
<?php

$login = $_POST['login'];
$pass = $_POST['pass'];
require 'Connexion2.php';
$query = "SELECT count(*) FROM users WHERE login='$login' and pass='$pass'";
$result = mysqli_query($connexion2, $query);
$row = mysqli_fetch_row($result);
if ($row[0] == 0)
    header('location:index.php');
else  {
    // agood user
    $query="SELECT * FROM users WHERE login='$login'";
    $result = mysqli_query($connexion2, $query);
    $row = mysqli_fetch_array($result);
    session_start();
    $_SESSION['admin_id'] = $login; // badge
    $_SESSION['LAT'] = time();
    $_SESSION['name'] = $row['Name'];
    header('location:Administrateur.php');
}
?>