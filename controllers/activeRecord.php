<? 
require './config/define.php';
class activeRecord extends controller{
	function welcome(){
		require_once("./libs/Pagination.php");
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1){
			// Load the database configuration file 
			$db = $this->model("database");
			$database = new Database();

			// $_GET['url']="http://localhost/fukushisystem/activeRecord/?page=1";
			// echo $_GET['url'];

			// $components = parse_url($_GET['url']);
			// parse_str($components['query'], $results);
			// echo($results['page']); 

			// if (isset($_REQUEST['page'])) {
			// 	echo $_REQUEST['page'];
			// }else{

			// }

			$paramsSearch 		= (!empty($_GET['search'])) ? $_GET['search'] : '';
			$paramsCurrentPage  = (!empty($_GET['page'])) ?  $_GET['page'] : 1;

			// Fetch records from database 
			$queryList[] = "SELECT * FROM usermanagement ORDER BY Name_hira ASC";

			// Query Count
			$queryCount[] =  "SELECT COUNT(*) AS `total` FROM `usermanagement` WHERE `Usermanagement_id` > 0";

			// Filter Search
			// if($paramsSearch != '')  {
			// 	$filterSearch 	= "AND `Recipient_number` LIKE '%$paramsSearch%'";
			// 	$queryList[] 	= $filterSearch;
			// 	$queryCount[] 	= $filterSearch;
			// }

			$totalItem = $database->fetchRow(implode(" ", $queryCount))['total'];
			
			$configPagination = ['totalItemsPerPage'	=> 10, 'pageRange' => 3, 'currentPage' => $paramsCurrentPage];
			$objPagination 	 = new Pagination($totalItem, $configPagination);
			// echo "<pre>";
			// print_r($objPagination);
			// echo "</pre>";

			// $database->setTable("usermanagement");

			// Pagination
			if($objPagination->getTotalPage() > 1)  {
				$totalPage		= $configPagination['totalItemsPerPage'];
				$position		= ($configPagination['currentPage']-1) * $totalPage;
				$queryList[] 	= "LIMIT $position, $totalPage";
			}

			$queryList = implode(" ", $queryList);
			// echo $queryList;
			// print_r($queryList);
			// exit();

			$listItem = $database->fetchAll($queryList);
			// foreach ($listItem as $item) {
			// 	// print_r($item);

			// }

			require_once("./views/activeRecordDirector.html");
		}else{
			// echo "<script>alert('unit');</script>";
			if (isset($_SESSION['usernameSS2'])) {
				header("Location: ".WEB_URL."unit");
			}else{
				header("Location: ".WEB_URL."login");
			}
		}
	}
	function A(){
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("activityrecord");
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1){

		$arr = $this->UrlProcess();
		//get request month 
		$ym = date("Y-m");
		if(isset($_REQUEST['ym'])){
			$ym = $_REQUEST['ym'];
		}
		// 月の日数
		$year = substr($ym, 0,4);
		$month = substr($ym,strpos($ym, "-")+1,strlen($ym));
		$numberOfDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		// get all item by Recipient_number and date
		$queryList = "SELECT * FROM activityrecord WHERE `Recipient_number` = '".$_REQUEST['Recipient_number']."' and DATE_FORMAT(date, '%Y-%m') = '".$ym."'";
		// echo $queryList;
		$recRecord = $database->fetchAll($queryList);
		$days = array('日', '月', '火', '水', '木', '金', '土');
		// data 
		$dataRecord  =[];
		if(is_array($recRecord)){
			
			for($j = 1;$j<=$numberOfDay; $j++){
				$currentDate = $ym."-".$j;
				$date = strtotime($currentDate);
				$tmp = [];
				$tmp["ID"] = $j;
				$tmp["dateview"] = $month."月".$j."日(".$days[date('w', $date)]."曜日)";
				$tmp["Date"] = $currentDate;
				foreach($recRecord as $val){
					if($currentDate ==$val["Date"]){
						$tmp["Activity_record_id"] = $val["Activity_record_id"];
						$tmp["Start_time"] = $val["Start_time"];
						$tmp["End_time"] = $val["End_time"];
						$tmp["Tsusho"] = $val["Tsusho"];
						$tmp["Pick_drop"] = $val["Pick_drop"];
						$tmp["Remark"] = $val["Remark"];
						break;
					}
				}
				array_push($dataRecord, $tmp);
			}
		}
		// print_r($dataRecord);
		$countItem;
			// echo $arr[2];
			if (isset($arr[2])) {
				// Query Count
				$queryCount =  "SELECT COUNT(*) AS `total` FROM `activityrecord` WHERE `Activity_record_id` = ".$arr[2];
				$countItem = $database->fetchRow($queryCount)['total'];
			}

			if ($countItem != 0) {
				$queryList = "SELECT * FROM activityrecord WHERE `Activity_record_id` = ".$arr[2];
				$listItem = $database->fetchRow($queryList);
			}
			// echo $listItem['Recipient_number'];
			// echo $queryList;
			// print_r($listItem);
			// exit();

			require_once("./views/activeRecordA.html");

					if ($_POST["Tsusho"] == "attendance") {
						$tsusho =1;
					}else{
						$tsusho =0;
					}
			if (isset($_POST["btn_activeRecord"])) {
				// $queryList[] = "SELECT `Date` FROM activityrecord WHERE `Recipient_number` = ".$_POST["Recipient_number"];

				// 	$queryList = implode(" ", $queryList);

				// 	$listItem = $database->fetchAll($queryList);
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
					header("Location: ".WEB_URL."activeRecord/A");
					}else{
						$dateElements = explode('-', $_POST["Date"]);
						$al1 = "'は'+".$dateElements[0].$dateElements[1]."";
						echo "<script>alert('受給者番号：'+".$_POST["Recipient_number"]."+".$al1."+'ありました。');</script>";
					}
			}else if(isset($_POST["btn_activeRecordUpdate"])) {
				// echo "<script>alert('受給者番号：');</script>";
					$queryList = "SELECT  COUNT(`Recipient_number`) AS `total` FROM activityrecord WHERE `Date` ="."'".$_POST["Date"]."'";
					// $queryList = implode(" ", $queryList);
					$listItem = $database->fetchRow($queryList)['total'];
					if ($listItem != 0) {
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
					// echo $arr[2];
					// $data = array(['Activity_record_id', $arr[2] ]);
					// foreach($data as $value){
					// 	echo $value[0]."=".$value[1].$value[2];

					// }
					$list =  $database->update($data, array(['Activity_record_id', $arr[2] ]));
					// print_r($list);
					// exit();
					// header("Location: /fukushisystem/activeRecord/A/".$arr[2]."");
					echo "<script>
							UpdateActiveRecord();
							function UpdateActiveRecord(page){
						        var result = confirm('修正されました。');
						        if (result) {
						        	url = '".WEB_URL."activeRecord/A/".$arr[2]."';
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
			header("Location: ".WEB_URL."userMNMT");
		}
	}
	function B(){
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("activityrecord");
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1){
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
				header("Location: ".WEB_URL."activeRecord/B");
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: ".WEB_URL."unit");
		}
	}
	function migration(){
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("activityrecord");
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1){
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
				header("Location: ".WEB_URL."activeRecord/Migration");
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: ".WEB_URL."unit");
		}
	}
	function insertOrUpdateActiveRecord(){
		try{
			$db = $this->model("database");
			$database = new Database();
			$database->setTable("activityrecord");
			$date = $_REQUEST['Date'];
			if(!is_array($date)){
				exit();
			}
			foreach($date as $key=> $val){
				$data = array(
					'Recipient_number' 			=> $_REQUEST["Recipient_number"],
					'Date' 						=> $_REQUEST["Date"][$key],
					'Tsusho' 					=> $_REQUEST["Tsusho"][$key],
					'Start_time' 				=> $_REQUEST["Start_time"][$key],
					'End_time' 					=> $_REQUEST["End_time"][$key],
					'Pick_drop' 				=> $_REQUEST["Pick_drop"][$key],
					'Remark' 					=> $_REQUEST["Remark"][$key]
				);
				if(!empty($_REQUEST["Activity_record_id"][$key])){
					$database->update($data, array(['Activity_record_id', $_REQUEST["Activity_record_id"][$key]]));
				}else{
					$database->insert($data);	
				}
				
			}
			echo 1;
			return;
		}catch(Exception $ex){
			echo $ex;
			return;
		}
	}
	function UrlProcess(){
		if (isset($_GET['url'])) {
			return explode("/", filter_var(trim($_GET['url'], "/")));
		}
	}
}
?>
