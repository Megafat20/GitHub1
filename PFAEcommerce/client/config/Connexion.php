<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE_NAME', 'e-commerce');

define('CURRENCY', 'MAD');
$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE_NAME);
if (!$connexion) {
    echo 'error: ' . mysqli_connect_error();
    exit();
}
?>