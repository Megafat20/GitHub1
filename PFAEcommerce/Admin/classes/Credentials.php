<?php
session_start();
/**
 * 
 */
class Credentials
{

	private $connexion;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->connexion = $db->connect();
	}



	public function createAdminAccount($name, $login, $pass)
	{
		$q = $this->connexion->query("SELECT * FROM users WHERE login = '$login' LIMIT=1");
		if ($q->num_rows > 0) {
			return ['status' => 303, 'message' => 'login already exists'];
		} else {
			$pass = password_hash($pass, PASSWORD_BCRYPT, ["COST" => 8]);
			$q = $this->connexion->query("INSERT INTO `users`(`login`, `pass`, `Name`, `active`) VALUES ('$login','$pass','$name','0')");
			if ($q) {
				return ['status' => 202, 'message' => 'Admin Created Successfully'];
			}
		}
	}

	public function loginAdmin($login, $pass)
	{
		$q = $this->connexion->query("SELECT * FROM users WHERE 'login' = '$login' LIMIT 1");
		
		if ($q->num_rows > 0) {
			$row = $q->fetch_assoc();
			if (password_verify($pass, $row['pass'])) {
				$_SESSION['admin_name'] = $row['Name'];
				$_SESSION['admin_id'] = $row['login'];
				return ['status' => 202, 'message' => 'Login Successful'];
			} else {
				return ['status' => 303, 'message' => 'Login Fail'];
			}
		} else {
			return ['status' => 303, 'message' => 'Account not created yet with this email'];
		}
	}
}

//$c = new Credentials();
//$c->createAdminAccount("Rizwan", "rizwan@gmail.com", "12345");

//PRINT_R($c->loginAdmin("rizwan@gmail.com", "12345"));

if (isset($_POST['admin_register'])) {
	extract($_POST);
	if (!empty($name) && !empty($login) && !empty($pass) && !empty($cpass)) {
		if ($pass == $cpass) {
			$c = new Credentials();
			$result = $c->createAdminAccount($name, $login, $pass);
			echo json_encode($result);
			exit();
		} else {
			echo json_encode(['status' => 303, 'message' => 'Password mismatch']);
			exit();
		}
	} else {
		echo json_encode(['status' => 303, 'message' => 'Empty fields']);
		exit();
	}
}

if (isset($_POST['admin_login'])) {
	$login=$_POST['login'];
	$pass=$_POST['password'];
	if (!empty($login) && !empty($pass)) {
		$c = new Credentials();
		$result = $c->loginAdmin($login, $pass);
		echo json_encode($result);
		exit();
	} else {
		echo json_encode(['status' => 303, 'message' => 'Empty fields']);
		exit();
	}
}
