<? 

class userMNMT extends controller{
	function welcome(){
		require_once("./libs/Pagination.php");
		// if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1){
		// 	// Load the database configuration file 
		// 	$db = $this->model("database");
		// 	$database = new Database();
		// 	// $database->setTable("usermanagement");
		// 	// Fetch records from database 

		// 	$paramsCurrentPage  = (!empty($_GET['page'])) ?  $_GET['page'] : 1;

		// 	// Query Count
		// 	$queryCount =  "SELECT COUNT(*) AS `total` FROM `usermanagement` WHERE `Usermanagement_id` > 0";

		// 	$totalItem = $database->fetchRow($queryCount)['total'];
		// 	$configPagination = ['totalItemsPerPage'	=> 10, 'pageRange' => 3, 'currentPage' => $paramsCurrentPage];
		// 	$objPagination 	 = new Pagination($totalItem, $configPagination);

		// 	$queryList[] = "SELECT * FROM usermanagement ORDER BY Recipient_number ASC";

		// 	if($objPagination->getTotalPage() > 1)  {
		// 		$totalPage		= $configPagination['totalItemsPerPage'];
		// 		$position		= ($configPagination['currentPage']-1) * $totalPage;
		// 		$queryList[] 	= "LIMIT $position, $totalPage";
		// 	}

		// 	$queryList = implode(" ", $queryList);

		// 	$listItem = $database->fetchAll($queryList);
		// 	// foreach ($listItem as $item) {
		// 	// 	// print_r($item);

		// 	// }
		// 	require_once("./libs/Pagination.php");
		// 	require_once("./views/userMNMTDirector.html");
		// }else{
		// 	// echo "<script>alert('unit');</script>";
			
		// 	if (isset($_SESSION['usernameSS2'])) {
		// 		header("Location: /fukushisystem/unit");
		// 	}else{
		// 		header("Location: /fukushisystem/login");
		// 	}
		// }

		$arr = $this->UrlProcess();
		$path = dirname(__FILE__,2); 

		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1){
			// Load the database configuration file 
			$db = $this->model("database");
			$database = new Database();
			// $database->setTable("usermanagement");
			// Fetch records from database 

			$paramsCurrentPage  = (!empty($_GET['page'])) ?  $_GET['page'] : 1;

			// Query Count
			$queryCount =  "SELECT COUNT(*) AS `total` FROM `business` WHERE `Business_id` > 0";

			$totalItem = $database->fetchRow($queryCount)['total'];
			$configPagination = ['totalItemsPerPage'	=> 10, 'pageRange' => 3, 'currentPage' => $paramsCurrentPage];
			$objPagination 	 = new Pagination($totalItem, $configPagination);

			$queryList[] = "SELECT * FROM business ORDER BY Model_number ASC";

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
			require_once("./views/userBusiness.html");
		}else{
			// echo "<script>alert('unit');</script>";
			if (isset($_SESSION['usernameSS2'])) {
				header("Location: /fukushisystem/unit");
			}else{
				header("Location: /fukushisystem/login");
			}
		}
	}
	function A(){
		require_once("./views/head.html");
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("usermanagement");
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1){
			$queryListBusiness[] = "SELECT Businesser_number FROM business ORDER BY Businesser_number ASC";
			$queryListBusiness = implode(" ", $queryListBusiness);
			$listItemBusiness = $database->fetchAll($queryListBusiness);
			// print_r($listItem);
			// exit();
			$arr = $this->UrlProcess();
			$countItem;
				// echo $arr[2];
				if (isset($arr[2])) {
					// Query Count
					$queryCount =  "SELECT COUNT(*) AS `total` FROM `usermanagement` WHERE `Usermanagement_id` = ".$arr[2];
					$countItem = $database->fetchRow($queryCount)['total'];
				}

				if ($countItem != 0) {
					$queryList = "SELECT * FROM usermanagement WHERE `Usermanagement_id` = ".$arr[2];
					$listItem = $database->fetchRow($queryList);
				}

			require_once("./views/userMNMTA.html");
			if (isset($_POST["btn_userMNMT"])) {
				$data = array(
					'Businesser_number' 				=> $_POST["Businesser_number"],
					'Name_hira' 						=> $_POST["Name_hira"],
					'Name_kana' 						=> $_POST["Name_kana"],
					'Recipient_number' 					=> $_POST["Recipient_number"],
					'Supply_municipalitie' 				=> $_POST["Supply_municipalitie"],
					'Disability_support_type' 			=> $_POST["Disability_support_type"],
					'Business_up_limit' 				=> $_POST["Business_up_limit"],
					'Business_exemption_amount' 		=> $_POST["Business_exemption_amount"],
					'Service_start_date' 				=> $_POST["Service_start_date"],
					'Service_end_date' 					=> $_POST["Service_end_date"],
					'Contract_field_number' 			=> $_POST["Contract_field_number"],
					'Contract_date' 					=> $_POST["Contract_date"],
					'Contract_end_date' 				=> $_POST["Contract_end_date"],
					'Contract_payment_amount' 			=> $_POST["Contract_payment_amount"],
					'Initial_addition' 					=> $_POST["Initial_addition"],
					'Nursing_plan_notcreated' 			=> $_POST["Nursing_plan_notcreated"],
					'Pick_drop_same_site' 				=> $_POST["Pick_drop_same_site"],
					'Max_mgmt_office_number' 			=> $_POST["Max_mgmt_office_number"],
					'Max_mgmt_office_name' 				=> $_POST["Max_mgmt_office_name"],
					'Max_mgmt_result' 					=> $_POST["Max_mgmt_result"],
					'Max_mgmt_after_user_burden' 		=> $_POST["Max_mgmt_after_user_burden"],
					'Max_mgmt_addition' 				=> $_POST["Max_mgmt_addition"],
					'Special_use_start_date' 			=> $_POST["Special_use_start_date"],
					'Special_use_end_date' 				=> $_POST["Special_use_end_date"],
					'Special_use_year_principle' 		=> $_POST["Special_use_year_principle"],
					'Special_use_month_day' 			=> $_POST["Special_use_month_day"],
					'Special_use_each_month' 			=> $_POST["Special_use_each_month"],
					'Structout_support_cumulative' 		=> $_POST["Structout_support_cumulative"],
					'Rechargeable' 						=> $_POST["Rechargeable"],
					'Other_compay_use_status' 			=> $_POST["Other_compay_use_status"],
					'Office_name' 						=> $_POST["Office_name"],
					'User_burden_limit_start' 			=> $_POST["User_burden_limit_start"],
					'User_burden_limit_end' 			=> $_POST["User_burden_limit_end"],
					'Usermanagement_type' 				=> 1
				);
				$database->insert($data);
				header("Location: /fukushisystem/userMNMT/A");
			}else if(isset($_POST["btn_userMNMTUpdate"])) {
				// echo "<script>alert('受給者番号：');</script>";
				// exit();
					if (isset($arr[2])) {
						$data = array(
							'Businesser_number' 				=> $_POST["Businesser_number"],
							'Name_hira' 						=> $_POST["Name_hira"],
							'Name_kana' 						=> $_POST["Name_kana"],
							'Recipient_number' 					=> $_POST["Recipient_number"],
							'Supply_municipalitie' 				=> $_POST["Supply_municipalitie"],
							'Disability_support_type' 			=> $_POST["Disability_support_type"],
							'Business_up_limit' 				=> $_POST["Business_up_limit"],
							'Business_exemption_amount' 		=> $_POST["Business_exemption_amount"],
							'Service_start_date' 				=> $_POST["Service_start_date"],
							'Service_end_date' 					=> $_POST["Service_end_date"],
							'Contract_field_number' 			=> $_POST["Contract_field_number"],
							'Contract_date' 					=> $_POST["Contract_date"],
							'Contract_end_date' 				=> $_POST["Contract_end_date"],
							'Contract_payment_amount' 			=> $_POST["Contract_payment_amount"],
							'Initial_addition' 					=> $_POST["Initial_addition"],
							'Nursing_plan_notcreated' 			=> $_POST["Nursing_plan_notcreated"],
							'Pick_drop_same_site' 				=> $_POST["Pick_drop_same_site"],
							'Max_mgmt_office_number' 			=> $_POST["Max_mgmt_office_number"],
							'Max_mgmt_office_name' 				=> $_POST["Max_mgmt_office_name"],
							'Max_mgmt_result' 					=> $_POST["Max_mgmt_result"],
							'Max_mgmt_after_user_burden' 		=> $_POST["Max_mgmt_after_user_burden"],
							'Max_mgmt_addition' 				=> $_POST["Max_mgmt_addition"],
							'Special_use_start_date' 			=> $_POST["Special_use_start_date"],
							'Special_use_end_date' 				=> $_POST["Special_use_end_date"],
							'Special_use_year_principle' 		=> $_POST["Special_use_year_principle"],
							'Special_use_month_day' 			=> $_POST["Special_use_month_day"],
							'Special_use_each_month' 			=> $_POST["Special_use_each_month"],
							'Structout_support_cumulative' 		=> $_POST["Structout_support_cumulative"],
							'Rechargeable' 						=> $_POST["Rechargeable"],
							'Other_compay_use_status' 			=> $_POST["Other_compay_use_status"],
							'Office_name' 						=> $_POST["Office_name"],
							'User_burden_limit_start' 			=> $_POST["User_burden_limit_start"],
							'User_burden_limit_end' 			=> $_POST["User_burden_limit_end"],
							'Usermanagement_type' 				=> 1
						);
					// echo $arr[2];
					// $data = array(['Activity_record_id', $arr[2] ]);
					// foreach($data as $value){
					// 	echo $value[0]."=".$value[1].$value[2];

					// }
					$list =  $database->update($data, array(['Usermanagement_id', $arr[2] ]));
					// print_r($list);
					// exit();
					// header("Location: /fukushisystem/activeRecord/A/".$arr[2]."");
					echo "<script>
							UpdateUserMNMT();
							function UpdateUserMNMT(){
						        var result = confirm('修正されました。');
						        if (result) {
						        	url = '/fukushisystem/userMNMT/A/".$arr[2]."';
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
	function B(){
		require_once("./views/head.html");
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("usermanagement");
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1){
			require_once("./views/userMNMTB.html");
			if (isset($_POST["btn_userMNMT"])) {
				$data = array(
					'Businesser_number' 				=> $_POST["Businesser_number"],
					'Name_hira' 						=> $_POST["Name_hira"],
					'Name_kana' 						=> $_POST["Name_kana"],
					'Recipient_number' 					=> $_POST["Recipient_number"],
					'Supply_municipalitie' 				=> $_POST["Supply_municipalitie"],
					'Disability_support_type' 			=> $_POST["Disability_support_type"],
					'Business_up_limit' 				=> $_POST["Business_up_limit"],
					'Business_exemption_amount' 		=> $_POST["Business_exemption_amount"],
					'Service_start_date' 				=> $_POST["Service_start_date"],
					'Service_end_date' 					=> $_POST["Service_end_date"],
					'Contract_field_number' 			=> $_POST["Contract_field_number"],
					'Contract_date' 					=> $_POST["Contract_date"],
					'Contract_end_date' 				=> $_POST["Contract_end_date"],
					'Contract_payment_amount' 			=> $_POST["Contract_payment_amount"],
					'Initial_addition' 					=> $_POST["Initial_addition"],
					'Nursing_plan_notcreated' 			=> $_POST["Nursing_plan_notcreated"],
					'Pick_drop_same_site' 				=> $_POST["Pick_drop_same_site"],
					'Max_mgmt_office_number' 			=> $_POST["Max_mgmt_office_number"],
					'Max_mgmt_office_name' 				=> $_POST["Max_mgmt_office_name"],
					'Max_mgmt_result' 					=> $_POST["Max_mgmt_result"],
					'Max_mgmt_after_user_burden' 		=> $_POST["Max_mgmt_after_user_burden"],
					'Max_mgmt_addition' 				=> $_POST["Max_mgmt_addition"],
					'Special_use_start_date' 			=> $_POST["Special_use_start_date"],
					'Special_use_end_date' 				=> $_POST["Special_use_end_date"],
					'Special_use_year_principle' 		=> $_POST["Special_use_year_principle"],
					'Special_use_month_day' 			=> $_POST["Special_use_month_day"],
					'Special_use_each_month' 			=> $_POST["Special_use_each_month"],
					'Facility_support' 					=> $_POST["Facility_support"],
					'Rechargeable' 						=> $_POST["Rechargeable"],
					'Other_compay_use_status' 			=> $_POST["Other_compay_use_status"],
					'Office_name' 						=> $_POST["Office_name"],
					'Usermanagement_type' 				=> 2
				);
				$database->insert($data);
				header("Location: /fukushisystem/userMNMT/B");
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/unit");
		}
	}
	function migration(){
		require_once("./views/head.html");
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("usermanagement");
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1){
			require_once("./views/userMNMTMigration.html");
			if (isset($_POST["btn_userMNMT"])) {
				$data = array(
					'Businesser_number' 				=> $_POST["Businesser_number"],
					'Name_hira' 						=> $_POST["Name_hira"],
					'Name_kana' 						=> $_POST["Name_kana"],
					'Recipient_number' 					=> $_POST["Recipient_number"],
					'Supply_municipalitie' 				=> $_POST["Supply_municipalitie"],
					'Disability_support_type' 			=> $_POST["Disability_support_type"],
					'Business_up_limit' 				=> $_POST["Business_up_limit"],
					'Business_exemption_amount' 		=> $_POST["Business_exemption_amount"],
					'Service_start_date' 				=> $_POST["Service_start_date"],
					'Service_end_date' 					=> $_POST["Service_end_date"],
					'Contract_field_number' 			=> $_POST["Contract_field_number"],
					'Contract_date' 					=> $_POST["Contract_date"],
					'Contract_end_date' 				=> $_POST["Contract_end_date"],
					'Contract_payment_amount' 			=> $_POST["Contract_payment_amount"],
					'Initial_addition' 					=> $_POST["Initial_addition"],
					'Nursing_plan_notcreated' 			=> $_POST["Nursing_plan_notcreated"],
					'Pick_drop_same_site' 				=> $_POST["Pick_drop_same_site"],
					'Max_mgmt_office_number' 			=> $_POST["Max_mgmt_office_number"],
					'Max_mgmt_office_name' 				=> $_POST["Max_mgmt_office_name"],
					'Max_mgmt_result' 					=> $_POST["Max_mgmt_result"],
					'Max_mgmt_after_user_burden' 		=> $_POST["Max_mgmt_after_user_burden"],
					'Max_mgmt_addition' 				=> $_POST["Max_mgmt_addition"],
					'Special_use_start_date' 			=> $_POST["Special_use_start_date"],
					'Special_use_end_date' 				=> $_POST["Special_use_end_date"],
					'Special_use_year_principle' 		=> $_POST["Special_use_year_principle"],
					'Special_use_month_day' 			=> $_POST["Special_use_month_day"],
					'Special_use_each_month' 			=> $_POST["Special_use_each_month"],
					'Transition_support' 				=> $_POST["Transition_support"],
					'Rechargeable' 						=> $_POST["Rechargeable"],
					'Other_compay_use_status' 			=> $_POST["Other_compay_use_status"],
					'Office_name' 						=> $_POST["Office_name"],
					'Usermanagement_type' 				=> 3
				);
				$database->insert($data);
				header("Location: /fukushisystem/userMNMT/migration");
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/unit");
		}
	}
	function List(){
		// echo $_GET['Businesser_number'];
		// exit();
		require_once("./libs/Pagination.php");
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1){
			// Load the database configuration file 
			$db = $this->model("database");
			$database = new Database();
			// $database->setTable("usermanagement");
			// Fetch records from database 

			$paramsCurrentPage  = (!empty($_GET['page'])) ?  $_GET['page'] : 1;

			// Query Count
			$queryCount =  "SELECT COUNT(*) AS `total` FROM `usermanagement` WHERE `Businesser_number` = ".$_GET['Businesser_number'];
			// echo $queryCount;
			// exit();

			$totalItem = $database->fetchRow($queryCount)['total'];
			$configPagination = ['totalItemsPerPage'	=> 10, 'pageRange' => 3, 'currentPage' => $paramsCurrentPage];
			$objPagination 	 = new Pagination($totalItem, $configPagination);

			$queryList[] = "SELECT * FROM usermanagement WHERE `Businesser_number` = ".$_GET['Businesser_number'];
			// print_r($queryList);
			// exit(); 

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
			require_once("./views/userMNMTDirector.html");
		}else{
			// echo "<script>alert('unit');</script>";
			
			if (isset($_SESSION['usernameSS2'])) {
				header("Location: /fukushisystem/unit");
			}else{
				header("Location: /fukushisystem/login");
			}
		}
	}
	function UrlProcess(){
		if (isset($_GET['url'])) {
			return explode("/", filter_var(trim($_GET['url'], "/")));
		}
	}
}
?>
