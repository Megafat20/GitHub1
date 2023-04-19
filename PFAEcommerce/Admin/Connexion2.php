<?php
#1-connextion to database
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'e-commerce');
$connexion2 = mysqli_connect(HOST, USER, PASS, DB);
if (!$connexion2) {
    echo 'error: ' . mysqli_connect_error();
    exit();
}
?>