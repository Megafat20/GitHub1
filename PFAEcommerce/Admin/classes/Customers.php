<?php
session_start();
/**
 * 
 */
class Customers
{

	private $connexion;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->connexion = $db->connect();
	}

	public function getCustomers()
	{
		$query = $this->connexion->query("SELECT * FROM client");
		$ar = [];
		if (@$query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
				$ar[] = $row;
			}
			return ['status' => 202, 'message' => $ar];
		}
		return ['status' => 303, 'message' => 'no customer data'];
	}


	public function getCustomersOrder()
	{
		$query = $this->connexion->query("SELECT * FROM Bondecommande ");
		$ar = [];
		if (@$query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
				$ar[] = $row;
			}
			return ['status' => 202, 'message' => $ar];
		}
		return ['status' => 303, 'message' => 'no orders yet'];
	}
}


/*$c = new Customers();
echo "<pre>";
print_r($c->getCustomers());
exit();*/

if (isset($_POST["GET_CUSTOMERS"])) {
	if (isset($_SESSION['admin_id'])) {
		$c = new Customers();
		echo json_encode($c->getCustomers());
		exit();
	}
}

if (isset($_POST["GET_CUSTOMER_ORDERS"])) {
	if (isset($_SESSION['admin_id'])) {
		$c = new Customers();
		echo json_encode($c->getCustomersOrder());
		exit();
	}
}
