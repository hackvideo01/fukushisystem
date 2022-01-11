<? 

class userMNMT extends controller{
	function welcome(){
		if (isset($_SESSION['usernameSS1'])){
			// Load the database configuration file 
			$db = $this->model("database");
			$database = new Database();
			// $database->setTable("usermanagement");
			// Fetch records from database 
			$queryList[] = "SELECT * FROM usermanagement ORDER BY Recipient_number ASC";

			$queryList = implode(" ", $queryList);

			$listItem = $database->fetchAll($queryList);
			// foreach ($listItem as $item) {
			// 	// print_r($item);

			// }
			require_once("./views/userMNMTDirector.html");
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/unit");
		}
	}
	function A(){
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("usermanagement");
		if (isset($_SESSION['usernameSS1'])){
			require_once("./views/userMNMTA.html");
			if (isset($_POST["btn_userMNMT"])) {
				$data = array(
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
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/unit");
		}
	}
	function B(){
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("usermanagement");
		if (isset($_SESSION['usernameSS1'])){
			require_once("./views/userMNMTB.html");
			if (isset($_POST["btn_userMNMT"])) {
				$data = array(
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
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("usermanagement");
		if (isset($_SESSION['usernameSS1'])){
			require_once("./views/userMNMTMigration.html");
			if (isset($_POST["btn_userMNMT"])) {
				$data = array(
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
}
?>
