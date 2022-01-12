<? 
class unit extends controller{
	function welcome(){
		require_once("./libs/Pagination.php");
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
		if (isset($_SESSION['usernameSS2'])){
			// Load the database configuration file 
			$db = $this->model("database");
			$database = new Database();
			// $database->setTable("usermanagement");
			// Fetch records from database 

			$paramsCurrentPage  = (!empty($_GET['page'])) ?  $_GET['page'] : 1;

			// Query Count
			$queryCount =  "SELECT COUNT(*) AS `total` FROM `unit` WHERE `Unit_id` > 0";

			$totalItem = $database->fetchRow($queryCount)['total'];
			$configPagination = ['totalItemsPerPage'	=> 10, 'pageRange' => 3, 'currentPage' => $paramsCurrentPage];
			$objPagination 	 = new Pagination($totalItem, $configPagination);

			$queryList[] = "SELECT * FROM unit ORDER BY Unit_id ASC";

			// Pagination
			if($objPagination->getTotalPage() > 1)  {
				$totalPage		= $configPagination['totalItemsPerPage'];
				$position		= ($configPagination['currentPage']-1) * $totalPage;
				$queryList[] 	= "LIMIT $position, $totalPage";
			}

			$queryList = implode(" ", $queryList);

			$listItem = $database->fetchAll($queryList);
			// foreach ($listItem as $item) {
			// 	// print_r($item);

			// }
			require_once("./views/unitMNMT.html");
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/unit");
		}
	}
	function Update(){
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("unit");
		if (isset($_SESSION['usernameSS2'])){
			require_once("./views/unitNew.html");
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
			header("Location: /fukushisystem/unit");
		}
	}
}
?>
