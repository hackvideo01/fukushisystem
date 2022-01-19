<? 
class memberMaster extends controller{
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
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==0){
			// Load the database configuration file 
			$db = $this->model("database");
			$database = new Database();
			// $database->setTable("usermanagement");
			// Fetch records from database 

			$paramsCurrentPage  = (!empty($_GET['page'])) ?  $_GET['page'] : 1;

			// Query Count
			$queryCount =  "SELECT COUNT(*) AS `total` FROM `membermaster` WHERE `MemberMaster_Id` > 0";
		
			$totalItem = $database->fetchRow($queryCount)['total'];

			$configPagination = ['totalItemsPerPage'	=> 10, 'pageRange' => 3, 'currentPage' => $paramsCurrentPage];
			$objPagination 	 = new Pagination($totalItem, $configPagination);

			$queryList[] = "SELECT * FROM membermaster ORDER BY MemberMaster_Id ASC";

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
			require_once("./views/memberMasterMNMT.html");
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/userMNMT");
		}
	}
	function Update(){
		require_once("./views/head.html");
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("membermaster");
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==0){
			$arr = $this->UrlProcess();
			$countItem;
				// echo $arr[2];
				if (isset($arr[2])) {
					// Query Count
					$queryCount =  "SELECT COUNT(*) AS `total` FROM `membermaster` WHERE `MemberMaster_Id` = ".$arr[2];
					$countItem = $database->fetchRow($queryCount)['total'];
				}

				if ($countItem != 0) {
					$queryList = "SELECT * FROM membermaster WHERE `MemberMaster_Id` = ".$arr[2];
					$listItem = $database->fetchRow($queryList);
				}
			require_once("./views/memberMasterNew.html");
			// echo "<script>alert('ok');</script>";
			
			if (isset($_POST["btn_memberMaster"])) {
				$queryList = "SELECT  COUNT(`MemberMaster_Id`) AS `total` FROM membermaster WHERE MemberMaster_Id ="."'".$_POST["MemberMaster_Id"]."'";
				// $queryList = implode(" ", $queryList);
				$listItem = $database->fetchRow($queryList)['total'];
				// print_r($listItem);
				// echo $listItem;
				// exit();
				if ($listItem==0) {
					$data = array(
						'CompanyName' 				=> $_POST["CompanyName"],
						'PostCode' 					=> $_POST["PostCode"],
						'Address' 					=> $_POST["Address"],
						'TelephoneNumber' 			=> $_POST["TelephoneNumber"],
						'PersonChargeName' 			=> $_POST["PersonChargeName"],
						'PersonChargeInformation' 	=> $_POST["PersonChargeInformation"],
						'EmailAddress' 				=> $_POST["EmailAddress"]
					);
				$database->insert($data);
				header("Location: /fukushisystem/memberMaster");
				}else{
					echo "<script>alert('サービスコードはありました。');</script>";
				}
			}else if(isset($_POST["btn_unitUpdate"])) {
				// echo "<script>alert('受給者番号：');</script>";
					$queryList = "SELECT  COUNT(`MemberMaster_Id`) AS `total` FROM membermaster WHERE `MemberMaster_Id` =".$arr[2];
					// $queryList = implode(" ", $queryList);
					$listItem = $database->fetchRow($queryList)['total'];
					if ($listItem != 0) {
						$data = array(
							'CompanyName' 				=> $_POST["CompanyName"],
							'PostCode' 					=> $_POST["PostCode"],
							'Address' 					=> $_POST["Address"],
							'TelephoneNumber' 			=> $_POST["TelephoneNumber"],
							'PersonChargeName' 			=> $_POST["PersonChargeName"],
							'PersonChargeInformation' 	=> $_POST["PersonChargeInformation"],
							'EmailAddress' 				=> $_POST["EmailAddress"]
						);
					// echo $arr[2];
					// $data = array(['Activity_record_id', $arr[2] ]);
					// foreach($data as $value){
					// 	echo $value[0]."=".$value[1].$value[2];

					// }
					$list =  $database->update($data, array(['MemberMaster_Id', $arr[2] ]));
					// print_r($list);
					// exit();
					// header("Location: /fukushisystem/activeRecord/A/".$arr[2]."");
					echo "<script>
							UpdateMemberMaster();
							function UpdateMemberMaster(){
						        var result = confirm('修正されました。');
						        if (result) {
						        	url = '/fukushisystem/memberMaster/Update/".$arr[2]."';
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
			header("Location: /fukushisystem/memberMaster");
		}
	}
	function UrlProcess(){
		if (isset($_GET['url'])) {
			return explode("/", filter_var(trim($_GET['url'], "/")));
		}
	}
}
?>
