<? 
require './config/define.php';
class municipality extends controller{
	function welcome(){
		require_once("./libs/Pagination.php");
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==0){
			// Load the database configuration file 
			$db = $this->model("database");
			$database = new Database();
			// $database->setTable("usermanagement");
			// Fetch records from database 

			$paramsCurrentPage  = (!empty($_GET['page'])) ?  $_GET['page'] : 1;

			// Query Count
			$queryCount =  "SELECT COUNT(*) AS `total` FROM `municipality` WHERE `Municipality_id` > 0";

			$totalItem = $database->fetchRow($queryCount)['total'];
			$configPagination = ['totalItemsPerPage'	=> 10, 'pageRange' => 3, 'currentPage' => $paramsCurrentPage];
			$objPagination 	 = new Pagination($totalItem, $configPagination);

			$queryList[] = "SELECT * FROM municipality ORDER BY Municipality_id ASC";

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
			require_once("./views/municipalityMNMT.html");
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: ".WEB_URL."userMNMT");
		}
	}
	function Update(){
		// require_once("./views/head.html");
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("municipality");
		$comfirm = 0;
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==0){
			$arr = $this->UrlProcess();
			$countItem;
				// echo $arr[2];
				if (isset($arr[2])) {
					// Query Count
					$queryCount =  "SELECT COUNT(*) AS `total` FROM `municipality` WHERE `Municipality_id` = ".$arr[2];
					$countItem = $database->fetchRow($queryCount)['total'];
				}

				if ($countItem != 0) {
					$queryList = "SELECT * FROM municipality WHERE `Municipality_id` = ".$arr[2];
					$listItem = $database->fetchRow($queryList);
				}
			
			// echo "<script>alert('ok');</script>";
			if (isset($_POST["btn_municipalityCheck"])) {
				$_SESSION['Municipality_number'] = $_POST["Municipality_number"];
				$_SESSION['Municipality'] = $_POST["Municipality"];
				$comfirm = 1;
			}
				
			
			if (isset($_POST["btn_municipality"])) {
				$queryList = "SELECT  COUNT(`Municipality_id`) AS `total` FROM municipality WHERE Municipality_id ="."'".$_POST["Municipality_id"]."'";
				// $queryList = implode(" ", $queryList);
				$listItem = $database->fetchRow($queryList)['total'];
				// print_r($listItem);
				// echo $listItem;
				// exit();
				if ($listItem==0) {
					$data = array(
						'Municipality' 				=> $_SESSION['Municipality_number'],
						'Municipality_number' 		=> $_SESSION['Municipality']
					);
				$database->insert($data);
				header("Location: ".WEB_URL."municipality");
				}else{
					echo "<script>alert('??????????????????????????????????????????');</script>";
				}
			}else if(isset($_POST["btn_municipalityUpdate"])) {
				// echo "<script>alert('??????????????????');</script>";
					$queryList = "SELECT  COUNT(`Municipality_id`) AS `total` FROM municipality WHERE `Municipality_id` =".$arr[2];
					// $queryList = implode(" ", $queryList);
					$listItem = $database->fetchRow($queryList)['total'];
					if ($listItem != 0) {
						$data = array(
							'Municipality' 				=> $_POST["Municipality"],
							'Municipality_number' 		=> $_POST["Municipality_number"]
						);
					// echo $arr[2];
					// $data = array(['Activity_record_id', $arr[2] ]);
					// foreach($data as $value){
					// 	echo $value[0]."=".$value[1].$value[2];

					// }
					$list =  $database->update($data, array(['Municipality_id', $arr[2] ]));
					// print_r($list);
					// exit();
					// header("Location: /fukushisystem/activeRecord/A/".$arr[2]."");
					echo "<script>
							UpdateMunicipality();
							function UpdateMunicipality(){
						        var result = confirm('????????????????????????');
						        if (result) {
						        	url = '".WEB_URL."municipality/Update/".$arr[2]."';
						        	window.location.href = url;
						        }
						    }

						 </script>";

					}else{
						echo "<script>alert('??????????????????');";
					}
			}
			require_once("./views/municipalityNew.html");
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: ".WEB_URL."municipality");
		}
	}
	function UrlProcess(){
		if (isset($_GET['url'])) {
			return explode("/", filter_var(trim($_GET['url'], "/")));
		}
	}
}
?>
