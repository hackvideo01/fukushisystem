<? 
class unit extends controller{
	function welcome(){
		// Load the database configuration file 
		$db = $this->model("database");
		$database = new Database();
		// $database->setTable("usermanagement");
		// Fetch records from database 
		// $queryList[] = "SELECT * FROM activityrecord WHERE 17";

		// $queryList = implode(" ", $queryList);

		// $listItem = $database->fetchAll($queryList);
		// foreach ($listItem as $item) {
		// 	// print_r($item);

		// }
		
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("unit");
		if (isset($_SESSION['usernameSS2'])){
			require_once("./views/unit.html");
			// echo "<script>alert('ok');</script>";
			
			if (isset($_POST["btn_unit"])) {
				$queryList = "SELECT  COUNT(`Unit_code`) AS `total` FROM unit WHERE Unit_code ="."'".$_POST["Unit_code"]."'";
				// $queryList = implode(" ", $queryList);
				$listItem = $database->fetchRow($queryList)['total'];
				// print_r($listItem);
				// echo $listItem;
				// exit();
				if ($listItem==0) {
					$data = array(
					'Unit_code' 				=> $_POST["Unit_code"],
					'Service_content' 			=> $_POST["Service_content"],
					'Number_unit' 				=> $_POST["Number_unit"],
					'Unit_price' 				=> $_POST["Unit_price"]
				);
				$database->insert($data);
				header("Location: /fukushisystem/unit");
				}else{
					echo "<script>alert('サービスコードはありました。');</script>";
				}
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/userMNMT");
		}
	}
	function A(){
		
	}
}
?>
