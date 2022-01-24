<? 
require './config/define.php';
class display_data extends controller{
	function welcome(){
		require_once("./libs/Pagination.php");

		// Load the database configuration file 
		// $db = $this->model("database");
		// $database = new Database();
		// $database->setTable("usermanagement");
		// Fetch records from database 
		// $queryList[] = "SELECT * FROM activityrecord ORDER BY Recipient_number ASC";

		// $queryList = implode(" ", $queryList);

		// $listItem = $database->fetchAll($queryList);
		// foreach ($listItem as $item) {
		// 	// print_r($item);

		// }
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1){
			// Load the database configuration file 
			$db = $this->model("database");
			$database = new Database();
			// $database->setTable("usermanagement");
			// Fetch records from database 

			$paramsCurrentPage  = (!empty($_GET['page'])) ?  $_GET['page'] : 1;

			// Query Count
			$queryCount =  "SELECT COUNT(*) AS `total` FROM `activityrecord` WHERE `Activity_record_id` > 0";

			$totalItem = $database->fetchRow($queryCount)['total'];
			$configPagination = ['totalItemsPerPage'	=> 10, 'pageRange' => 3, 'currentPage' => $paramsCurrentPage];
			$objPagination 	 = new Pagination($totalItem, $configPagination);

			$queryList[] = "SELECT * FROM activityrecord ORDER BY Recipient_number ASC";

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
			require_once("./views/display_data.html");
		}else{
			// echo "<script>alert('unit');</script>";
			if (isset($_SESSION['usernameSS2'])) {
				header("Location: ".WEB_URL."unit");
			}else{
				header("Location: ".WEB_URL."login");
			}
		}
		// require_once("./views/display_data.html");
	}
	
	function exportData(){
		define('TIMEZONE', 'Asia/Tokyo');
		date_default_timezone_set(TIMEZONE);
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
		    $filename = "SV".$check_year_month."01".".csv"; 
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

		    $databaseEX = new Database();
		    $databaseEX->setTable('historyex');
		    $dataEX = array(
		    	'FileNameEX'	=>	"SV".$check_year_month."01",
		    	'Comment'		=>	'成功',
		    	'DateEX'		=>	date('Y/m/d H:i:s')
		    );
		    $databaseEX->insert($dataEX);
		     
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
		define('TIMEZONE', 'Asia/Tokyo');
		date_default_timezone_set(TIMEZONE);
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
		    $filename = "SE".$check_year_month."01.csv"; 
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
					// echo $queryListMu;
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

		    $databaseEX = new Database();
		    $databaseEX->setTable('historyex');
		    $dataEX = array(
		    	'FileNameEX'	=>	"SE".$check_year_month."01",
		    	'Comment'		=>	'成功',
		    	'DateEX'		=>	date('Y/m/d H:i:s')
		    );
		    $databaseEX->insert($dataEX);
		     
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
	function historyExport(){
		// require_once("./views/head.html");
		require_once("./libs/Pagination.php");
		
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1){
			// Load the database configuration file 
			$db = $this->model("database");
			$database = new Database();
			// $database->setTable("usermanagement");
			// Fetch records from database 

			$paramsCurrentPage  = (!empty($_GET['page'])) ?  $_GET['page'] : 1;

			// Query Count
			$queryCount =  "SELECT COUNT(*) AS `total` FROM `historyex` WHERE `HistoryEX_id` > 0";

			$totalItem = $database->fetchRow($queryCount)['total'];
			$configPagination = ['totalItemsPerPage'	=> 10, 'pageRange' => 3, 'currentPage' => $paramsCurrentPage];
			$objPagination 	 = new Pagination($totalItem, $configPagination);

			$queryList[] = "SELECT * FROM historyex ORDER BY DateEX ASC";

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
			require_once("./views/historyEX.html");
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: ".WEB_URL."unit");
		}
	}
}
?>
