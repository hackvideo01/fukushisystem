<?
	// require_once 'database.php';
	// require_once "../models/database.php";
	require_once dirname(__FILE__) . '/../models/database.php';
	if($_POST["action"] == "deleteActiveRecord"){
	
	 	$dataID = $_POST["id"];
	 	// echo "<script>alert('".$dataID."');</script>";
	 	// exit();
		if( $dataID !=null){
			deleteActiveRecord((int)$dataID);	
		}
	}

	if($_POST["action"] == "deleteUserMNMT"){
	
	 	$dataID = $_POST["id"];
	 	// echo "<script>alert('".$dataID."');</script>";
	 	// exit();
		if( $dataID !=null){
			deleteUserMNMT((int)$dataID);	
		}
	}

	if($_POST["action"] == "deleteBusiness"){
	
	 	$dataID = $_POST["id"];
	 	// echo "<script>alert('".$dataID."');</script>";
	 	// exit();
		if( $dataID !=null){
			deleteBusiness((int)$dataID);	
		}
	}

	function deleteActiveRecord($ID){

		$database = new Database();
		// $database->setTable("activityrecord");
		$queryList = "DELETE FROM activityrecord WHERE `Activity_record_id`=".$ID;

		// $queryList = implode(" ", $queryList);
		$exc = $database->execute($queryList);

		return;
	}

	function deleteUserMNMT($ID){

		$database = new Database();
		// $database->setTable("activityrecord");
		$queryList = "DELETE FROM usermanagement WHERE `Usermanagement_id`=".$ID;

		// $queryList = implode(" ", $queryList);
		$exc = $database->execute($queryList);

		return;
	}

	function deleteBusiness($ID){

		$database = new Database();
		// $database->setTable("activityrecord");
		$queryList = "DELETE FROM business WHERE `Business_id`=".$ID;

		// $queryList = implode(" ", $queryList);
		$exc = $database->execute($queryList);

		return;
	}
?>