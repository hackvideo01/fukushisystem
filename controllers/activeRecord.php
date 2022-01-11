<? 
class activeRecord extends controller{
	function welcome(){
		if (isset($_SESSION['usernameSS1'])){
			// Load the database configuration file 
			$db = $this->model("database");
			$database = new Database();
			// $database->setTable("usermanagement");
			// Fetch records from database 
			$queryList[] = "SELECT * FROM activityrecord ORDER BY Recipient_number ASC";

			$queryList = implode(" ", $queryList);

			$listItem = $database->fetchAll($queryList);
			// foreach ($listItem as $item) {
			// 	// print_r($item);

			// }
			require_once("./views/activeRecordDirector.html");
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/unit");
		}
	}
	function A(){
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("activityrecord");
		if (isset($_SESSION['usernameSS1'])){
			require_once("./views/activeRecordA.html");
					if ($_POST["Tsusho"] == "attendance") {
						$tsusho =1;
					}else{
						$tsusho =0;
					}
					
			if (isset($_POST["btn_activeRecord"])) {
				$queryList[] = "SELECT `Date` FROM activityrecord WHERE `Recipient_number` = ".$_POST["Recipient_number"];

					$queryList = implode(" ", $queryList);

					$listItem = $database->fetchAll($queryList);
					// foreach ($variable as $key => $value) {
						// if ($_POST['Recipient_number'] != null) {
						// 	header("Location: /fukushisystem/activeRecord/B");
						// }
					// }
					// exit();
					// $time = strtotime($_POST["Date"]);
					// $day = date("D",$time);
					// $month = date("F",$time);
					// $year = date("Y",$time);

					$queryList = "SELECT  COUNT(`Recipient_number`) AS `total` FROM activityrecord WHERE `Date` ="."'".$_POST["Date"]."'";
					// $queryList = implode(" ", $queryList);
					$listItem = $database->fetchRow($queryList)['total'];
					// echo $_POST["Date"];
					// if ($listItem == 0) {
					// 	echo "<script>alert('ok');</script>";
					// }else{
					// 	echo "string";
					// }
					// exit();

					if ($listItem == 0) {
						$dateElements = explode('-', $_POST["Date"]);
						$data = array(
							'Recipient_number' 			=> $_POST["Recipient_number"],
							'Date' 						=> $_POST["Date"],
							'Month_year' 				=> $dateElements[0].$dateElements[1],
							'Day_week' 					=> $dateElements[2],
							'Day' 						=> $_POST["Day"],
							'Tsusho' 					=> $tsusho,
							'Start_time' 				=> $_POST["Start_time"],
							'End_time' 					=> $_POST["End_time"],
							'Meal_addition' 			=> $_POST["Meal_addition"],
							'Pick_drop' 				=> $_POST["Pick_drop"],
							'Experience_use' 			=> $_POST["Experience_use"],
							'Visit_support' 			=> $_POST["Visit_support"],
							'Work_out_facility' 		=> $_POST["Work_out_facility"],
							'Social_life' 				=> $_POST["Social_life"],
							'Life_home' 				=> $_POST["Life_home"],
							'Medical_cooperation' 		=> $_POST["Medical_cooperation"],
							'Remark' 					=> $_POST["Remark"],
							'Actual_cost1' 				=> $_POST["Actual_cost1"],
							'Actual_cost2' 				=> $_POST["Actual_cost2"],
							'ActiveRecord_type' 		=> 1
						);
					$database->insert($data);
					header("Location: /fukushisystem/activeRecord/A");
					}else{
						$dateElements = explode('-', $_POST["Date"]);
						$al1 = "'は'+".$dateElements[0].$dateElements[1]."";
						echo "<script>alert('受給者番号：'+".$_POST["Recipient_number"]."+".$al1."+'ありました。');</script>";
					}
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/userMNMT");
		}
	}
	function B(){
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("activityrecord");
		if (isset($_SESSION['usernameSS1'])){
			require_once("./views/activeRecordB.html");
				if ($_POST["Tsusho"] == "attendance") {
					$tsusho =1;
				}else{
					$tsusho =0;
				}
			if (isset($_POST["btn_activeRecord"])) {
				$data = array(
					'Recipient_number' 			=> $_POST["Recipient_number"],
					'Date' 						=> $_POST["Date"],
					'Day' 						=> $_POST["Day"],
					'Tsusho' 					=> $tsusho,
					'Start_time' 				=> $_POST["Start_time"],
					'End_time' 					=> $_POST["End_time"],
					'Meal_addition' 			=> $_POST["Meal_addition"],
					'Pick_drop' 				=> $_POST["Pick_drop"],
					'Experience_use' 			=> $_POST["Experience_use"],
					'Visit_support' 			=> $_POST["Visit_support"],
					'Social_life' 				=> $_POST["Social_life"],
					'Life_home' 				=> $_POST["Life_home"],
					'Medical_cooperation' 		=> $_POST["Medical_cooperation"],
					'Remark' 					=> $_POST["Remark"],
					'Actual_cost1' 				=> $_POST["Actual_cost1"],
					'Actual_cost2' 				=> $_POST["Actual_cost2"],
					'Medical_alignment_number' 	=> $_POST["Medical_alignment_number"],
					'ActiveRecord_type' 		=> 2
				);
				$database->insert($data);
				header("Location: /fukushisystem/activeRecord/B");
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/unit");
		}
	}
	function migration(){
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("activityrecord");
		if (isset($_SESSION['usernameSS1'])){
			require_once("./views/activeRecordMigration.html");
				if ($_POST["Tsusho"] == "attendance") {
					$tsusho =1;
				}else{
					$tsusho =0;
				}
			if (isset($_POST["btn_activeRecord"])) {
				$data = array(
					'Recipient_number' 			=> $_POST["Recipient_number"],
					'Date' 						=> $_POST["Date"],
					'Day' 						=> $_POST["Day"],
					'Tsusho' 					=> $tsusho,
					'Start_time' 				=> $_POST["Start_time"],
					'End_time' 					=> $_POST["End_time"],
					'Meal_addition' 			=> $_POST["Meal_addition"],
					'Pick_drop' 				=> $_POST["Pick_drop"],
					'Experience_use' 			=> $_POST["Experience_use"],
					'Visit_support' 			=> $_POST["Visit_support"],
					'Prepare_migration' 		=> $_POST["Prepare_migration"],
					'Social_life' 				=> $_POST["Social_life"],
					'Work_training' 			=> $_POST["Work_training"],
					'Life_home' 				=> $_POST["Life_home"],
					'Medical_cooperation' 		=> $_POST["Medical_cooperation"],
					'Mental_institution' 		=> $_POST["Mental_institution"],
					'Remark' 					=> $_POST["Remark"],
					'Actual_cost1' 				=> $_POST["Actual_cost1"],
					'Actual_cost2' 				=> $_POST["Actual_cost2"],
					'ActiveRecord_type' 		=> 3
				);
				$database->insert($data);
				header("Location: /fukushisystem/activeRecord/Migration");
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/unit");
		}
	}
}
?>
