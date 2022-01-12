<? 
class business extends controller{
	function welcome(){
		require_once("./libs/Pagination.php");
		if (isset($_SESSION['usernameSS1'])){
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
			require_once("./views/businessDirector.html");
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/unit");
		}
	}
	function A(){
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("business");
		if (isset($_SESSION['usernameSS1'])){
			$arr = $this->UrlProcess();
			$countItem;
			
			// echo $arr[2];
			if (isset($arr[2])) {
				// Query Count
				$queryCount =  "SELECT COUNT(*) AS `total` FROM `business` WHERE `Business_id` = ".$arr[2];
				$countItem = $database->fetchRow($queryCount)['total'];
			}

			if ($countItem != 0) {
				$queryList = "SELECT * FROM business WHERE `Business_id` = ".$arr[2];
				$listItem = $database->fetchRow($queryList);
			}
				
			require_once("./views/businessA.html");
			if (isset($_POST["btn_business"])) {
				// echo $_POST["Service_offer_date"];
				// exit();
				$data = array(
					'Model_number' 					=> $_POST["Model_number"],
					'Model_symbol' 					=> $_POST["Model_symbol"],
					'Service_offer_date' 			=> $_POST["Service_offer_date"],
					'Corporate_name' 				=> $_POST["Corporate_name"],
					'Representative' 				=> $_POST["Representative"],
					'Businesser_name' 				=> $_POST["Businesser_name"],
					'Abbreviation' 					=> $_POST["Abbreviation"],
					'Administrator' 				=> $_POST["Administrator"],
					'Businesser_number' 			=> $_POST["Businesser_number"],
					'Businesser_postal_code' 		=> $_POST["Businesser_postal_code"],
					'Businesser_address' 			=> $_POST["Businesser_address"],
					'Businesser_phone' 				=> $_POST["Businesser_phone"],
					'Kind' 							=> $_POST["Kind"],
					'Evaluation_point_type' 		=> $_POST["Evaluation_point_type"],
					'Public' 						=> $_POST["Public"],
					'Area_type' 					=> $_POST["Area_type"],
					'Capacity' 						=> $_POST["Capacity"],
					'Capacity_type' 				=> $_POST["Capacity_type"],
					'Work_migration_support' 		=> $_POST["Work_migration_support"],
					'Work_settle_number' 			=> $_POST["Work_settle_number"],
					'Vison_hear_support' 			=> $_POST["Vison_hear_support"],
					'Welfare_pro_staff_add' 		=> $_POST["Welfare_pro_staff_add"],
					'Severe_support_add1' 			=> $_POST["Severe_support_add1"],
					'Severe_support_add2' 			=> $_POST["Severe_support_add2"],
					'Care_link_nurse_staff' 		=> $_POST["Care_link_nurse_staff"],
					'Exemption_measures' 			=> $_POST["Exemption_measures"],
					'Pick_drop_kind_add' 			=> $_POST["Pick_drop_kind_add"],
					'Self_result_unpulic' 			=> $_POST["Self_result_unpulic"],
					'Body_not_abolition' 			=> $_POST["Body_not_abolition"],
					'Wage_improve' 					=> $_POST["Wage_improve"],
					'Area_life_support' 			=> $_POST["Area_life_support"],
					'Overcapacity' 					=> $_POST["Overcapacity"],
					'Employee_vacancy' 				=> $_POST["Employee_vacancy"],
					'Service_admin_vacancy' 		=> $_POST["Service_admin_vacancy"],
					'Treatment_improve' 			=> $_POST["Treatment_improve"],
					'Treatment_improve_num' 		=> $_POST["Treatment_improve_num"],
					'Treatment_career_improve' 		=> $_POST["Treatment_career_improve"],
					'Special_treatment_improve_add' => $_POST["Special_treatment_improve_add"],
					'Treatment_improve_add' 		=> $_POST["Treatment_improve_add"],
					'Invoice_title' 				=> $_POST["Invoice_title"],
					'Invoice_name' 					=> $_POST["Invoice_name"],
					'User_invoice_remark' 			=> $_POST["User_invoice_remark"],
					'Actual_cost1' 					=> $_POST["Actual_cost1"],
					'Actual_cost2' 					=> $_POST["Actual_cost2"],
					'Business_type' 				=> 1
				);
				$database->insert($data);
				header("Location: /fukushisystem/business/A");
			}else if(isset($_POST["btn_businessUpdate"])) {
				// echo "<script>alert('受給者番号：');</script>";
				// exit();
					if (isset($arr[2])) {
						$data = array(
							'Model_number' 					=> $_POST["Model_number"],
							'Model_symbol' 					=> $_POST["Model_symbol"],
							'Service_offer_date' 			=> $_POST["Service_offer_date"],
							'Corporate_name' 				=> $_POST["Corporate_name"],
							'Representative' 				=> $_POST["Representative"],
							'Businesser_name' 				=> $_POST["Businesser_name"],
							'Abbreviation' 					=> $_POST["Abbreviation"],
							'Administrator' 				=> $_POST["Administrator"],
							'Businesser_number' 			=> $_POST["Businesser_number"],
							'Businesser_postal_code' 		=> $_POST["Businesser_postal_code"],
							'Businesser_address' 			=> $_POST["Businesser_address"],
							'Businesser_phone' 				=> $_POST["Businesser_phone"],
							'Kind' 							=> $_POST["Kind"],
							'Evaluation_point_type' 		=> $_POST["Evaluation_point_type"],
							'Public' 						=> $_POST["Public"],
							'Area_type' 					=> $_POST["Area_type"],
							'Capacity' 						=> $_POST["Capacity"],
							'Capacity_type' 				=> $_POST["Capacity_type"],
							'Work_migration_support' 		=> $_POST["Work_migration_support"],
							'Work_settle_number' 			=> $_POST["Work_settle_number"],
							'Vison_hear_support' 			=> $_POST["Vison_hear_support"],
							'Welfare_pro_staff_add' 		=> $_POST["Welfare_pro_staff_add"],
							'Severe_support_add1' 			=> $_POST["Severe_support_add1"],
							'Severe_support_add2' 			=> $_POST["Severe_support_add2"],
							'Care_link_nurse_staff' 		=> $_POST["Care_link_nurse_staff"],
							'Exemption_measures' 			=> $_POST["Exemption_measures"],
							'Pick_drop_kind_add' 			=> $_POST["Pick_drop_kind_add"],
							'Self_result_unpulic' 			=> $_POST["Self_result_unpulic"],
							'Body_not_abolition' 			=> $_POST["Body_not_abolition"],
							'Wage_improve' 					=> $_POST["Wage_improve"],
							'Area_life_support' 			=> $_POST["Area_life_support"],
							'Overcapacity' 					=> $_POST["Overcapacity"],
							'Employee_vacancy' 				=> $_POST["Employee_vacancy"],
							'Service_admin_vacancy' 		=> $_POST["Service_admin_vacancy"],
							'Treatment_improve' 			=> $_POST["Treatment_improve"],
							'Treatment_improve_num' 		=> $_POST["Treatment_improve_num"],
							'Treatment_career_improve' 		=> $_POST["Treatment_career_improve"],
							'Special_treatment_improve_add' => $_POST["Special_treatment_improve_add"],
							'Treatment_improve_add' 		=> $_POST["Treatment_improve_add"],
							'Invoice_title' 				=> $_POST["Invoice_title"],
							'Invoice_name' 					=> $_POST["Invoice_name"],
							'User_invoice_remark' 			=> $_POST["User_invoice_remark"],
							'Actual_cost1' 					=> $_POST["Actual_cost1"],
							'Actual_cost2' 					=> $_POST["Actual_cost2"],
							'Business_type' 				=> 1
						);
					// echo $arr[2];
					// $data = array(['Activity_record_id', $arr[2] ]);
					// foreach($data as $value){
					// 	echo $value[0]."=".$value[1].$value[2];

					// }
					$list =  $database->update($data, array(['Business_id', $arr[2] ]));
					// print_r($list);
					// exit();
					// header("Location: /fukushisystem/activeRecord/A/".$arr[2]."");
					echo "<script>
							UpdateBusiness();
							function UpdateBusiness(){
						        var result = confirm('修正されました。');
						        if (result) {
						        	url = '/fukushisystem/business/A/".$arr[2]."';
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
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("business");
		if (isset($_SESSION['usernameSS1'])){
			require_once("./views/businessB.html");
			if (isset($_POST["btn_business"])) {
				$data = array(
					'Model_number' 					=> $_POST["Model_number"],
					'Model_symbol' 					=> $_POST["Model_symbol"],
					'Service_offer_date' 			=> $_POST["Service_offer_date"],
					'Corporate_name' 				=> $_POST["Corporate_name"],
					'Representative' 				=> $_POST["Representative"],
					'Businesser_name' 				=> $_POST["Businesser_name"],
					'Abbreviation' 					=> $_POST["Abbreviation"],
					'Administrator' 				=> $_POST["Administrator"],
					'Businesser_number' 			=> $_POST["Businesser_number"],
					'Businesser_postal_code' 		=> $_POST["Businesser_postal_code"],
					'Businesser_address' 			=> $_POST["Businesser_address"],
					'Businesser_phone' 				=> $_POST["Businesser_phone"],
					'Kind' 							=> $_POST["Kind"],
					'Average_wages_type' 			=> $_POST["Average_wages_type"],
					'Public' 						=> $_POST["Public"],
					'Area_type' 					=> $_POST["Area_type"],
					'Capacity' 						=> $_POST["Capacity"],
					'Capacity_type' 				=> $_POST["Capacity_type"],
					'Standard_calculation' 			=> $_POST["Standard_calculation"],
					'Work_migration_support' 		=> $_POST["Work_migration_support"],
					'Work_settle_number' 			=> $_POST["Work_settle_number"],
					'Vison_hear_support' 			=> $_POST["Vison_hear_support"],
					'Goal_wages_achievement_add1' 	=> $_POST["Goal_wages_achievement_add1"],
					'Goal_wages_achievement_add2' 	=> $_POST["Goal_wages_achievement_add2"],
					'Goal_wages_achievement_add3' 	=> $_POST["Goal_wages_achievement_add3"],
					'Welfare_pro_staff_add' 		=> $_POST["Welfare_pro_staff_add"],
					'Severe_support_add1' 			=> $_POST["Severe_support_add1"],
					'Goal_wages_placement_add' 		=> $_POST["Goal_wages_placement_add"],
					'Severe_support_add2' 			=> $_POST["Severe_support_add2"],
					'Care_link_nurse_staff' 		=> $_POST["Care_link_nurse_staff"],
					'Pick_drop_kind_add' 			=> $_POST["Pick_drop_kind_add"],
					'Body_not_abolition' 			=> $_POST["Body_not_abolition"],
					'Area_life_support' 			=> $_POST["Area_life_support"],
					'Overcapacity' 					=> $_POST["Overcapacity"],
					'Employee_vacancy' 				=> $_POST["Employee_vacancy"],
					'Service_admin_vacancy' 		=> $_POST["Service_admin_vacancy"],
					'Treatment_improve' 			=> $_POST["Treatment_improve"],
					'Treatment_improve_num' 		=> $_POST["Treatment_improve_num"],
					'Treatment_career_improve' 		=> $_POST["Treatment_career_improve"],
					'Special_treatment_improve_add' => $_POST["Special_treatment_improve_add"],
					'Treatment_improve_add' 		=> $_POST["Treatment_improve_add"],
					'Invoice_title' 				=> $_POST["Invoice_title"],
					'Invoice_name' 					=> $_POST["Invoice_name"],
					'User_invoice_remark' 			=> $_POST["User_invoice_remark"],
					'Actual_cost1' 					=> $_POST["Actual_cost1"],
					'Actual_cost2' 					=> $_POST["Actual_cost2"],
					'Business_type' 				=> 2
				);
				$database->insert($data);
				header("Location: /fukushisystem/business/B");
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/unit");
		}
	}
	function migration(){
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("business");
		if (isset($_SESSION['usernameSS1'])){
			require_once("./views/businessMigration.html");
			if (isset($_POST["btn_business"])) {
				$data = array(
					'Model_number' 						=> $_POST["Model_number"],
					'Model_symbol' 						=> $_POST["Model_symbol"],
					'Service_offer_date' 				=> $_POST["Service_offer_date"],
					'Corporate_name' 					=> $_POST["Corporate_name"],
					'Representative' 					=> $_POST["Representative"],
					'Businesser_name' 					=> $_POST["Businesser_name"],
					'Abbreviation' 						=> $_POST["Abbreviation"],
					'Administrator' 					=> $_POST["Administrator"],
					'Businesser_number' 				=> $_POST["Businesser_number"],
					'Businesser_postal_code' 			=> $_POST["Businesser_postal_code"],
					'Businesser_address' 				=> $_POST["Businesser_address"],
					'Businesser_phone' 					=> $_POST["Businesser_phone"],
					'Kind' 								=> $_POST["Kind"],
					'Evaluation_point_type' 			=> $_POST["Work_settlement_type"],
					'Public' 							=> $_POST["Public"],
					'Area_type' 						=> $_POST["Area_type"],
					'Capacity' 							=> $_POST["Capacity"],
					'Capacity_type' 					=> $_POST["Capacity_type"],
					'Vison_hear_support' 				=> $_POST["Vison_hear_support"],
					'Welfare_pro_staff_add' 			=> $_POST["Welfare_pro_staff_add"],
					'Work_support_add' 					=> $_POST["Work_support_add"],
					'Care_link_nurse_staff' 			=> $_POST["Care_link_nurse_staff"],
					'Pick_drop_kind_add' 				=> $_POST["Pick_drop_kind_add"],
					'Body_not_abolition' 				=> $_POST["Body_not_abolition"],
					'Area_life_support' 				=> $_POST["Area_life_support"],
					'Overcapacity' 						=> $_POST["Overcapacity"],
					'Employee_vacancy' 					=> $_POST["Employee_vacancy"],
					'Service_admin_vacancy' 			=> $_POST["Service_admin_vacancy"],
					'Standard_use_time' 				=> $_POST["Standard_use_time"],
					'Treatment_improve' 				=> $_POST["Treatment_improve"],
					'Treatment_improve_num' 			=> $_POST["Treatment_improve_num"],
					'Treatment_career_improve' 			=> $_POST["Treatment_career_improve"],
					'Special_treatment_improve_add' 	=> $_POST["Special_treatment_improve_add"],
					'Treatment_improve_add' 			=> $_POST["Treatment_improve_add"],
					'Invoice_title' 					=> $_POST["Invoice_title"],
					'Invoice_name' 						=> $_POST["Invoice_name"],
					'User_invoice_remark' 				=> $_POST["User_invoice_remark"],
					'Actual_cost1' 						=> $_POST["Actual_cost1"],
					'Actual_cost2' 						=> $_POST["Actual_cost2"],
					'Business_type' 					=> 3
				);
				$database->insert($data);
				header("Location: /fukushisystem/business/Migration");
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/unit");
		}
	}
	// function management(){
	// 	$db = $this->model("database");
	// 	$database = new Database();
	// 	$database->setTable("business");
	// 	if (isset($_SESSION['usernameSS1'])){
	// 		// require_once("./views/businessMigration.html");
	// 		// if (isset($_POST["btn_business"])) {
	// 		// 	$data = array(
	// 		// 		'Model_number' 						=> $_POST["Model_number"],
	// 		// 		'Model_symbol' 						=> $_POST["Model_symbol"],
	// 		// 		'Service_offer_date' 				=> $_POST["Service_offer_date"],
	// 		// 		'Corporate_name' 					=> $_POST["Corporate_name"],
	// 		// 		'Representative' 					=> $_POST["Representative"],
	// 		// 		'Businesser_name' 					=> $_POST["Businesser_name"],
	// 		// 		'Abbreviation' 						=> $_POST["Abbreviation"],
	// 		// 		'Administrator' 					=> $_POST["Administrator"],
	// 		// 		'Businesser_number' 				=> $_POST["Businesser_number"],
	// 		// 		'Businesser_postal_code' 			=> $_POST["Businesser_postal_code"],
	// 		// 		'Businesser_address' 				=> $_POST["Businesser_address"],
	// 		// 		'Businesser_phone' 					=> $_POST["Businesser_phone"],
	// 		// 		'Kind' 								=> $_POST["Kind"],
	// 		// 		'Evaluation_point_type' 			=> $_POST["Work_settlement_type"],
	// 		// 		'Public' 							=> $_POST["Public"],
	// 		// 		'Area_type' 						=> $_POST["Area_type"],
	// 		// 		'Capacity' 							=> $_POST["Capacity"],
	// 		// 		'Capacity_type' 					=> $_POST["Capacity_type"],
	// 		// 		'Vison_hear_support' 				=> $_POST["Vison_hear_support"],
	// 		// 		'Welfare_pro_staff_add' 			=> $_POST["Welfare_pro_staff_add"],
	// 		// 		'Work_support_add' 					=> $_POST["Work_support_add"],
	// 		// 		'Care_link_nurse_staff' 			=> $_POST["Care_link_nurse_staff"],
	// 		// 		'Pick_drop_kind_add' 				=> $_POST["Pick_drop_kind_add"],
	// 		// 		'Body_not_abolition' 				=> $_POST["Body_not_abolition"],
	// 		// 		'Area_life_support' 				=> $_POST["Area_life_support"],
	// 		// 		'Overcapacity' 						=> $_POST["Overcapacity"],
	// 		// 		'Employee_vacancy' 					=> $_POST["Employee_vacancy"],
	// 		// 		'Service_admin_vacancy' 			=> $_POST["Service_admin_vacancy"],
	// 		// 		'Standard_use_time' 				=> $_POST["Standard_use_time"],
	// 		// 		'Treatment_improve' 				=> $_POST["Treatment_improve"],
	// 		// 		'Treatment_improve_num' 			=> $_POST["Treatment_improve_num"],
	// 		// 		'Treatment_career_improve' 			=> $_POST["Treatment_career_improve"],
	// 		// 		'Special_treatment_improve_add' 	=> $_POST["Special_treatment_improve_add"],
	// 		// 		'Treatment_improve_add' 			=> $_POST["Treatment_improve_add"],
	// 		// 		'Invoice_title' 					=> $_POST["Invoice_title"],
	// 		// 		'Invoice_name' 						=> $_POST["Invoice_name"],
	// 		// 		'User_invoice_remark' 				=> $_POST["User_invoice_remark"],
	// 		// 		'Actual_cost1' 						=> $_POST["Actual_cost1"],
	// 		// 		'Actual_cost2' 						=> $_POST["Actual_cost2"],
	// 		// 		'Business_type' 					=> 3
	// 		// 	);
	// 		// 	$database->insert($data);
	// 		// 	header("Location: /fukushisystem/business/Migration");
	// 		// }
	// 		echo "Management";
	// 	}else{
	// 		// echo "<script>alert('unit');</script>";
	// 		header("Location: /fukushisystem/unit");
	// 	}
	// }
	function UrlProcess(){
		if (isset($_GET['url'])) {
			return explode("/", filter_var(trim($_GET['url'], "/")));
		}
	}
}
?>
