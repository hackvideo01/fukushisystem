<? 
class unit extends controller{
	function welcome(){
		require_once("./libs/Pagination.php");
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
			$arr = $this->UrlProcess();
			$countItem;
				// echo $arr[2];
				if (isset($arr[2])) {
					// Query Count
					$queryCount =  "SELECT COUNT(*) AS `total` FROM `unit` WHERE `Unit_id` = ".$arr[2];
					$countItem = $database->fetchRow($queryCount)['total'];
				}

				if ($countItem != 0) {
					$queryList = "SELECT * FROM unit WHERE `Unit_id` = ".$arr[2];
					$listItem = $database->fetchRow($queryList);
				}
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
			}else if(isset($_POST["btn_unitUpdate"])) {
				// echo "<script>alert('受給者番号：');</script>";
					$queryList = "SELECT  COUNT(`Unit_id`) AS `total` FROM unit WHERE `Unit_id` =".$arr[2];
					// $queryList = implode(" ", $queryList);
					$listItem = $database->fetchRow($queryList)['total'];
					if ($listItem != 0) {
						$data = array(
							'Unit_code' 				=> $_POST["Unit_code"],
							'Service_content' 			=> $_POST["Service_content"],
							'Number_unit' 				=> $_POST["Number_unit"],
							'Unit_price' 				=> $_POST["Unit_price"]
						);
					// echo $arr[2];
					// $data = array(['Activity_record_id', $arr[2] ]);
					// foreach($data as $value){
					// 	echo $value[0]."=".$value[1].$value[2];

					// }
					$list =  $database->update($data, array(['Unit_id', $arr[2] ]));
					// print_r($list);
					// exit();
					// header("Location: /fukushisystem/activeRecord/A/".$arr[2]."");
					echo "<script>
							UpdateUnit();
							function UpdateUnit(){
						        var result = confirm('修正されました。');
						        if (result) {
						        	url = '/fukushisystem/unit/Update/".$arr[2]."';
						        	window.location.href = url;
						        }
						    }

						 </script>";

					}else{
						echo "<script>alert('受給者番号：');";
					}
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/unit");
		}
	}
	function UrlProcess(){
		if (isset($_GET['url'])) {
			return explode("/", filter_var(trim($_GET['url'], "/")));
		}
	}
}
?>
