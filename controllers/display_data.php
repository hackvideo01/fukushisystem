<? 
class display_data extends controller{
	function welcome(){
		// Load the database configuration file 
		$db = $this->model("database");
		$database = new Database();
		// $database->setTable("usermanagement");
		// Fetch records from database 
		$queryList[] = "SELECT * FROM activityrecord WHERE 17";

		$queryList = implode(" ", $queryList);

		$listItem = $database->fetchAll($queryList);
		// foreach ($listItem as $item) {
		// 	// print_r($item);

		// }
		require_once("./views/display_data.html");
	}
	function A(){
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("usermanagement");
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
	}
	function exportData(){
		$check_year_month = $_POST['year'].$_POST['month'];
		// Load the database configuration file 
		$db = $this->model("database");
		$database = new Database();
		// $database->setTable("usermanagement");
		 
		// Fetch records from database 
		$queryList[] = "SELECT * FROM activityrecord WHERE Month_year = $check_year_month ORDER BY Recipient_number ASC";
		$queryList = implode(" ", $queryList);
		// echo $queryList = implode(" ", $queryList);
		// exit();
		$listItem = $database->fetchAll($queryList);


		$queryListCount[] = "SELECT COUNT(*) AS `total` FROM activityrecord";
		$queryListCount = implode(" ", $queryListCount);
		$listItemCount = $database->fetchRow($queryListCount)['total'];
		// echo $listItemCount;
		// exit();
			// print_r($item);
			// echo $item['Tsusho'];

			$delimiter = ","; 
		    $filename = "SV".date('Ymd') . ".csv"; 
		    $dateNow = date('Ym');
		     
		    // Create a file pointer 
		    $f = fopen('php://memory', 'w'); 
		    // echo $filename;
		    $total = 0;
		    $addChange = 0;
		    foreach ($listItem as $item) {
		    	$rec1 = $item['Recipient_number'];
		   		if ($rec1 != $rec2) {
		   			$addChange++;
		   			$total++;
		   		}else{
		   			$total++;
		   		}
		   		$rec2 = $item['Recipient_number'];
			}
			// Set column headers 
		 	$fields1 = array(1, 1, 0, $total+$addChange, 'J61', 0, 2210600272, 0, 1, $dateNow, 0);
		    fputcsv($f, $fields1, $delimiter);
		    // $fields2 = array(2, 2, 'J611', 1, 202106, 222257, 2210600272, $item['Recipient_number'], 1701);
		    // fputcsv($f, $fields2, $delimiter);
		    $rec2 = ""; 
		    $i=2;
		    foreach ($listItem as $item) {
		    	$rec11 = $item['Recipient_number'];
		   		if ($rec11 != $rec22) {
		   			$queryListMu = "SELECT * FROM usermanagement WHERE Recipient_number = ".$rec11;
					// $queryListMu = implode(" ", $queryListMu);
					$listItemMu = $database->fetchRow($queryListMu);
					// print_r($listItemMu);
					// exit();
		   			$fields2 = array(2, $i, 'J611', 1, $item['Month_year'], $listItemMu['Supply_municipalitie'], 2210600272, $item['Recipient_number'], 1701, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0);
		    		fputcsv($f, $fields2, $delimiter);
		    		$i++;
		    		$queryListDayWeek = "SELECT * FROM activityrecord WHERE Recipient_number = $rec11 && Month_year = $check_year_month ORDER BY Day_week ASC";
					$listItemDayWeek = $database->fetchAll($queryListDayWeek); 
					// print_r($listItemDayWeek);	
					$queryListMu = "SELECT * FROM usermanagement WHERE Recipient_number = ".$rec11;
					// $queryListMu = implode(" ", $queryListMu);
					$listItemMu = $database->fetchRow($queryListMu);
					foreach ($listItemDayWeek as $item) {
						if ($item['Tsusho'] == 1) {
							$fields3 = array(2, $i, 'J611', 2, $item['Month_year'], $listItemMu['Supply_municipalitie'], 2210600272, $item['Recipient_number'], 1701, '', $item['Day_week'], '', '', '', '', $item['Start_time']."00", $item['End_time']."00", '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
							fputcsv($f, $fields3, $delimiter);
						}else{
							$fields3 = array(2, $i, 'J611', 2, $item['Month_year'], $listItemMu['Supply_municipalitie'], 2210600272, $item['Recipient_number'], 1701, '', $item['Day_week'], '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
							fputcsv($f, $fields3, $delimiter);
						}
						$i++;
					}

		    		// $fields3 = array(2, $i, 'J611', 2, $item['Month_year'], 222257, 2210600272, $item['Recipient_number'], 1701, '', $item['Day_week'], '', '', '', '', $item['Start_time']."00", $item['End_time']."00");
		    		// fputcsv($f, $fields3, $delimiter);
		   			// $i++;
		   		}else{
		   			// $fields3 = array(2, $i, 'J611', 2, $item['Month_year'], 222257, 2210600272, $item['Recipient_number'], 1701, '', $item['Day_week'], '', '', '', '', $item['Start_time']."00", $item['End_time']."00");
		    		// fputcsv($f, $fields3, $delimiter);
		   			// $i++;
		   		}
		   		$rec22 = $item['Recipient_number'];
			}

			$fields4 = array(3, $i++);
    		fputcsv($f, $fields4, $delimiter);

		 	// Move back to beginning of file 
		    fseek($f, 0); 
		     
		    // Set headers to download file rather than displayed 
		 	// mb_convert_encoding($csv, 'UTF-16LE', 'UTF-8');
		 	// header('Content-Encoding: UTF-8');
			// header('Content-type: text/csv; charset=UTF-8');
		 	// header('Content-Disposition: attachment; filename="' . $filename . '";'); 

		    header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream'); 
			header('Content-Disposition: attachment; filename="' . $filename . '";'); 
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			echo "\xEF\xBB\xBF"; // UTF-8 BOM
			// echo $csv_file_content;
		    //output all remaining data on a file pointer 
		    fpassthru($f); 
		    exit; 

		
		// if($query->num_rows > 0){ 
		//     $delimiter = ","; 
		//     $filename = "members-data_" . date('Y-m-d') . ".csv"; 
		     
		//     // Create a file pointer 
		//     $f = fopen('php://memory', 'w'); 
		     
		//     // Set column headers 
		//     $fields = array('ID', 'FIRST NAME', 'LAST NAME', 'EMAIL', 'GENDER', 'COUNTRY', 'CREATED', 'STATUS'); 
		//     fputcsv($f, $fields, $delimiter); 
		     
		//     // Output each row of the data, format line as csv and write to file pointer 
		//     while($row = $query->fetch_assoc()){ 
		//         $status = ($row['status'] == 1)?'Active':'Inactive'; 
		//         $lineData = array($row['id'], $row['first_name'], $row['last_name'], $row['email'], $row['gender'], $row['country'], $row['created'], $status);
		//         fputcsv($f, $lineData, $delimiter); 
		//     }
		     
		//     // Move back to beginning of file 
		//     fseek($f, 0); 
		     
		//     // Set headers to download file rather than displayed 
		//     header('Content-Type: text/csv'); 
		//     header('Content-Disposition: attachment; filename="' . $filename . '";'); 
		     
		//     //output all remaining data on a file pointer 
		//     fpassthru($f); 
		// } 
		// exit; 
		 

		// echo '<script language="javascript">
		// 		confirm("LUC");
		//       </script>';

	}

	function exportDataSE(){
		$check_year_month = $_POST['year'].$_POST['month'];
		// Load the database configuration file 
		$db = $this->model("database");
		$database = new Database();
		// $database->setTable("usermanagement");
		 
		// Fetch records from database 
		$queryList[] = "SELECT * FROM activityrecord WHERE Month_year = $check_year_month ORDER BY Recipient_number ASC";
		$queryList = implode(" ", $queryList);
		// echo $queryList = implode(" ", $queryList);
		// exit();
		$listItem = $database->fetchAll($queryList);


		$queryListCount[] = "SELECT COUNT(*) AS `total` FROM activityrecord";
		$queryListCount = implode(" ", $queryListCount);
		$listItemCount = $database->fetchRow($queryListCount)['total'];
		// echo $listItemCount;
		// exit();
			// print_r($item);
			// echo $item['Tsusho'];

			$delimiter = ","; 
		    $filename = "SE".date('Ymd') . ".csv"; 
		    $dateNow = date('Ym');
		     
		    // Create a file pointer 
		    $f = fopen('php://memory', 'w'); 
		    // echo $filename;
		    $total = 0;
		    foreach ($listItem as $item) {

		    	$rec1 = $item['Recipient_number'];
		   		if ($rec1 != $rec2) {
		   			$addChange = $addChange + 6;
		   			$total++;
		   		}else{
		   			$total++;
		   		}
		   		$rec2 = $item['Recipient_number'];
			}
			// $addChange=+ 5;
			// echo $addChange;
			// exit();
			// Set column headers 
		 	$fields1 = array(1, 1, 0, $total+$addChange, 'J11', 0, 2210600272, 0, 1, $dateNow, 0);
		    fputcsv($f, $fields1, $delimiter);
		    // $fields2 = array(2, 2, 'J611', 1, 202106, 222257, 2210600272, $item['Recipient_number'], 1701);
		    // fputcsv($f, $fields2, $delimiter);
		    $rec2 = ""; 
		    $i=2;
		    foreach ($listItem as $item) {
		    	$rec11 = $item['Recipient_number'];
		   		if ($rec11 != $rec22) {
		   			$queryListMu = "SELECT * FROM usermanagement WHERE Recipient_number = ".$rec11;
					// $queryListMu = implode(" ", $queryListMu);
					$listItemMu = $database->fetchRow($queryListMu);
					// print_r($listItemMu);
					// exit();
					$fields2 = array(2, $i, 'J11', 1, $item['Month_year'], $listItemMu['Supply_municipalitie'], 2210600272, 166177, 1, 16340, 166177, 166177, 0, 0, 0, 0, 0, 0, 1, 16340, 166177
						, 166177, 0, 0, 0, '', '', '', '', '', '');
					fputcsv($f, $fields2, $delimiter);
					$i++;

					$fields2 = array(2, $i, 'J11', 2, $item['Month_year'], $listItemMu['Supply_municipalitie'], 2210600272, 1, 45, 1, 16340, 166177, 166177, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '');
					fputcsv($f, $fields2, $delimiter);
					$i++;

		   			$fields2 = array(2, $i, 'J121', 1, $item['Month_year'], $listItemMu['Supply_municipalitie'], 2210600272, $item['Recipient_number'],  '', $listItemMu['Name_kana'], '', 7, 1, 0, 1, '', '', 0, '', '', '', 16340, 166177, 0, '', '', '', '', 0, 166177);
		    		fputcsv($f, $fields2, $delimiter);
		    		$i++;

		    		$queryListDayWeek = "SELECT * FROM activityrecord WHERE Recipient_number = $rec11 && Month_year = $check_year_month ORDER BY Day_week ASC";
					$listItemDayWeek = $database->fetchAll($queryListDayWeek); 
					// print_r($listItemDayWeek);	
					$queryListMu = "SELECT * FROM usermanagement WHERE Recipient_number = ".$rec11;
					// $queryListMu = implode(" ", $queryListMu);
					$listItemMu = $database->fetchRow($queryListMu);
					$fields2 = array(2, $i, 'J121', 2, $item['Month_year'], $listItemMu['Supply_municipalitie'], 2210600272, $item['Recipient_number'], 45, 20150501, '', 21, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		    		fputcsv($f, $fields2, $delimiter);
		    		$i++;
					foreach ($listItemDayWeek as $item) {
						// if ($item['Tsusho'] == 1) {
							$fields3 = array(2, $i, 'J121', 3, $item['Month_year'], $listItemMu['Supply_municipalitie'], 2210600272, $item['Recipient_number'], 45, 20150501, '', 21, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
							fputcsv($f, $fields3, $delimiter);
						// }else{
						// 	$fields3 = array(2, $i, 'J121', 3, $item['Month_year'], $listItemMu['Supply_municipalitie'], 2210600272, $item['Recipient_number'], 45, 20150501, '', 21, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
						// 	fputcsv($f, $fields3, $delimiter);
						// }
						$i++;
					}
					$fields3 = array(2, $i, 'J121', 4, $item['Month_year'], $listItemMu['Supply_municipalitie'], 2210600272, $item['Recipient_number'], 45, 1, '', 20, 16340, 10170, 0, 166177, 16617, 16617, 0, '', '', '', '', '', '', '', '', '', '', '');
		    		fputcsv($f, $fields3, $delimiter);
		    		$i++;
		    		$fields3 = array(2, $i, 'J121', 5, $item['Month_year'], $listItemMu['Supply_municipalitie'], 2210600272, $item['Recipient_number'], 451000, 2200, 20201201, 20211130, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		    		fputcsv($f, $fields3, $delimiter);
		    		$i++;
		    		// $fields3 = array(2, $i, 'J611', 2, $item['Month_year'], 222257, 2210600272, $item['Recipient_number'], 1701, '', $item['Day_week'], '', '', '', '', $item['Start_time']."00", $item['End_time']."00");
		    		// fputcsv($f, $fields3, $delimiter);
		   			// $i++;
		   		}else{
		   			// $fields3 = array(2, $i, 'J611', 2, $item['Month_year'], 222257, 2210600272, $item['Recipient_number'], 1701, '', $item['Day_week'], '', '', '', '', $item['Start_time']."00", $item['End_time']."00");
		    		// fputcsv($f, $fields3, $delimiter);
		   			// $i++;
		   		}
		   		$rec22 = $item['Recipient_number'];
			}

			$fields4 = array(3, $i++);
    		fputcsv($f, $fields4, $delimiter);

		 	// Move back to beginning of file 
		    fseek($f, 0); 
		     
		    // Set headers to download file rather than displayed 
		 	// mb_convert_encoding($csv, 'UTF-16LE', 'UTF-8');
		 	// header('Content-Encoding: UTF-8');
			// header('Content-type: text/csv; charset=UTF-8');
		 	// header('Content-Disposition: attachment; filename="' . $filename . '";'); 

		    header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream'); 
			header('Content-Disposition: attachment; filename="' . $filename . '";'); 
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			echo "\xEF\xBB\xBF"; // UTF-8 BOM
			// echo $csv_file_content;
		    //output all remaining data on a file pointer 
		    fpassthru($f); 
		    exit; 

		
		// if($query->num_rows > 0){ 
		//     $delimiter = ","; 
		//     $filename = "members-data_" . date('Y-m-d') . ".csv"; 
		     
		//     // Create a file pointer 
		//     $f = fopen('php://memory', 'w'); 
		     
		//     // Set column headers 
		//     $fields = array('ID', 'FIRST NAME', 'LAST NAME', 'EMAIL', 'GENDER', 'COUNTRY', 'CREATED', 'STATUS'); 
		//     fputcsv($f, $fields, $delimiter); 
		     
		//     // Output each row of the data, format line as csv and write to file pointer 
		//     while($row = $query->fetch_assoc()){ 
		//         $status = ($row['status'] == 1)?'Active':'Inactive'; 
		//         $lineData = array($row['id'], $row['first_name'], $row['last_name'], $row['email'], $row['gender'], $row['country'], $row['created'], $status);
		//         fputcsv($f, $lineData, $delimiter); 
		//     }
		     
		//     // Move back to beginning of file 
		//     fseek($f, 0); 
		     
		//     // Set headers to download file rather than displayed 
		//     header('Content-Type: text/csv'); 
		//     header('Content-Disposition: attachment; filename="' . $filename . '";'); 
		     
		//     //output all remaining data on a file pointer 
		//     fpassthru($f); 
		// } 
		// exit; 
		 

		// echo '<script language="javascript">
		// 		confirm("LUC");
		//       </script>';

	}
}
?>
