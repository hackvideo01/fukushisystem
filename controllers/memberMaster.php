<? 
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		use PHPMailer\PHPMailer\SMTP;
		require './PHPMailer/src/Exception.php';
	    require './PHPMailer/src/PHPMailer.php';
	    require './PHPMailer/src/SMTP.php';
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
			$queryCount[] =  "SELECT COUNT(*) AS `total` FROM `users` WHERE `Id` > 0";
			$queryCount[] = "AND role = 1";
			$queryCount = implode(" ",$queryCount);
			
			$totalItem = $database->fetchRow($queryCount)['total'];

			$configPagination = ['totalItemsPerPage'	=> 10, 'pageRange' => 3, 'currentPage' => $paramsCurrentPage];
			$objPagination 	 = new Pagination($totalItem, $configPagination);

			$queryList[] = "SELECT * FROM users WHERE role = 1";

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
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("users");
		if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==0){
			$arr = $this->UrlProcess();
			$countItem;
				// echo $arr[2];
				if (isset($arr[2])) {
					// Query Count
					$queryCount =  "SELECT COUNT(*) AS `total` FROM `users` WHERE `Id` = ".$arr[2];
					$countItem = $database->fetchRow($queryCount)['total'];
				}

				if ($countItem != 0) {
					$queryList = "SELECT * FROM users WHERE `Id` = ".$arr[2];
					$listItem = $database->fetchRow($queryList);
				}
			require_once("./views/memberMasterNew.html");
			// echo "<script>alert('ok');</script>";
			
			if (isset($_POST["btn_memberMaster"])) {
				$databaseUsers = new Database();
				$databaseUsers->setTable("users");
				// $queryList = "SELECT  COUNT(`MemberMaster_Id`) AS `total` FROM membermaster WHERE MemberMaster_Id ="."'".$_POST["MemberMaster_Id"]."'";
				// // $queryList = implode(" ", $queryList);
				// $listItem = $database->fetchRow($queryList)['total'];
				// // print_r($listItem);
				// // echo $listItem;
				// // exit();
				// if ($listItem==0) {
				// 	$data = array(
				// 		'CompanyName' 				=> $_POST["CompanyName"],
				// 		'PostCode' 					=> $_POST["PostCode"],
				// 		'Address' 					=> $_POST["Address"],
				// 		'TelephoneNumber' 			=> $_POST["TelephoneNumber"],
				// 		'PersonChargeName' 			=> $_POST["PersonChargeName"],
				// 		'PersonChargeInformation' 	=> $_POST["PersonChargeInformation"],
				// 		'email' 					=> $_POST["email"]
				// 	);
				// $database->insert($data);
				// header("Location: /fukushisystem/memberMaster");
				// }else{
				// 	echo "<script>alert('サービスコードはありました。');</script>";
				// }

				$_SESSION['email'] = $_POST['email'];

		    if ($_POST['email']!="") {
				// $queryCount =  'SELECT COUNT(*) AS `total` FROM `users` WHERE `username` = "'.$_REQUEST["username"].'"';
				// $countItem = $database->fetchRow($queryCount)['total'];

				$queryCountEmail =  'SELECT COUNT(*) AS `total` FROM `users` WHERE `email` = "'.$_REQUEST["email"].'"';
				$countItemEmail = $database->fetchRow($queryCountEmail)['total'];

				if ($countItemEmail == 0) {
						$data = array(
						'username' 					=> $_POST["username"],
						'password' 					=> $_POST["password"],
						'email' 					=> $_POST["email"],
						'token'						=> $_POST['username']."123",
						'CompanyName' 				=> $_POST["CompanyName"],
						'PostCode' 					=> $_POST["PostCode"],
						'Address' 					=> $_POST["Address"],
						'TelephoneNumber' 			=> $_POST["TelephoneNumber"],
						'PersonChargeName' 			=> $_POST["PersonChargeName"],
						'PersonChargeInformation' 	=> $_POST["PersonChargeInformation"],
						'role' 						=> 1
					);
					$databaseUsers->insert($data);

			    $mailguest = new PHPMailer(true);                              // Passing `true` enables exceptions
			    try {
			        //Server settings
			        $mailguest->SMTPDebug = 3;                                 // Enable verbose debug output
			        $mailguest->isSMTP();                                      // Set mailer to use SMTP
			        $mailguest->Host = 'sv13156.xserver.jp';  // Specify main and backup SMTP servers
			        $mailguest->SMTPAuth = true;                               // Enable SMTP authentication
			        $mailguest->Username = 'no-reply@moff-mall.com';                 // SMTP username
			        $mailguest->Password = 'osakana3939';                           // SMTP password
			        $mailguest->SMTPSecure = 'TLS';                           // Enable TLS encryption, `ssl` also accepted
			        $mailguest->Port = 587;                                    // TCP port to connect to
			        $mailguest->CharSet = "UTF-8";

			        //Recipients
			        $mailguest->setFrom('no-reply@moff-mall.com','福祉システム');
			        $mailguest->addAddress($_POST['email']);     // Add a recipient



			        //Content
			        $mailguest->isHTML(true);                                  // Set email format to HTML
			        $mailguest->Subject = '福祉サービスへ登録ありがとうございます';
			        $mailguest->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
			        $mailguest->Body    = ''.$_POST['CompanyName'].'　様<br>
			                        <br><br>
			                        
			                        登録ありがとうございました。
			                        <br><br>

			                        アカウント名: '.$_POST['username'].'
			                        <br><br>
			                        パスワード: '.$_POST['password'].'
			                        <br><br>

			                            ';

			        $mailguest->send();
			        //echo 'Message has been sent';
			        header("Location: /fukushisystem/memberMaster/MemberSuccess");
			        
			    } catch (Exception $e) {
			        echo 'Message could not be sent.';
			        echo 'Mailer Error: ' . $mailguest->ErrorInfo;
			    }
			    }else if($countItem != 0){
						echo '<script>document.getElementById("acount-email-haved").style.display = "block";</script>';
				}else if($countItemEmail != 0){
						echo '<script>document.getElementById("email-haved").style.display = "block";</script>';
				}

			}else{
			    echo "<div>必須項目を入力ください</div>";
			}
			}else if(isset($_POST["btn_memberMasterUpdate"])) {
				// echo "<script>alert('受給者番号：');</script>";
					$queryList = "SELECT  COUNT(`Id`) AS `total` FROM users WHERE `Id` =".$arr[2];
					// $queryList = implode(" ", $queryList);
					$listItem = $database->fetchRow($queryList)['total'];

					$queryListEmail[] = "SELECT  COUNT(`email`) AS `total` FROM users WHERE `Id` !=".$arr[2];
					$queryListEmail[] = "AND `email` = '".$_POST['email']."'";
					$queryListEmail = implode(" ", $queryListEmail);
					$listItemEmail = $database->fetchRow($queryListEmail)['total'];
					
					if ($listItemEmail == 0) {
						if ($listItem != 0) {
						$data = array(
							'username' 					=> $_POST["username"],
							'password' 					=> $_POST["password"],
							'email' 					=> $_POST["email"],
							'token'						=> $_POST['username']."123",
							'CompanyName' 				=> $_POST["CompanyName"],
							'PostCode' 					=> $_POST["PostCode"],
							'Address' 					=> $_POST["Address"],
							'TelephoneNumber' 			=> $_POST["TelephoneNumber"],
							'PersonChargeName' 			=> $_POST["PersonChargeName"],
							'PersonChargeInformation' 	=> $_POST["PersonChargeInformation"]
						);

						// echo $arr[2];
						// $data = array(['Activity_record_id', $arr[2] ]);
						// foreach($data as $value){
						// 	echo $value[0]."=".$value[1].$value[2];

						// }
						$list =  $database->update($data, array(['Id', $arr[2] ]));
						// print_r($list);

						// header("Location: /fukushisystem/activeRecord/A/".$arr[2]."");
						$mailguest = new PHPMailer(true);                              // Passing `true` enables exceptions
				    try {
				        //Server settings
				        $mailguest->SMTPDebug = 3;                                 // Enable verbose debug output
				        $mailguest->isSMTP();                                      // Set mailer to use SMTP
				        $mailguest->Host = 'sv13156.xserver.jp';  // Specify main and backup SMTP servers
				        $mailguest->SMTPAuth = true;                               // Enable SMTP authentication
				        $mailguest->Username = 'no-reply@moff-mall.com';                 // SMTP username
				        $mailguest->Password = 'osakana3939';                           // SMTP password
				        $mailguest->SMTPSecure = 'TLS';                           // Enable TLS encryption, `ssl` also accepted
				        $mailguest->Port = 587;                                    // TCP port to connect to
				        $mailguest->CharSet = "UTF-8";

				        //Recipients
				        $mailguest->setFrom('no-reply@moff-mall.com','福祉システム');
				        $mailguest->addAddress($_POST['email']);     // Add a recipient



				        //Content
				        $mailguest->isHTML(true);                                  // Set email format to HTML
				        $mailguest->Subject = '福祉サービスへ情報が修正されました。';
				        $mailguest->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
				        $mailguest->Body    = ''.$_POST['CompanyName'].'　様<br>
				                        <br><br>
				                        
				                        登録ありがとうございました。
				                        <br><br>

				                        アカウント名: '.$_POST['username'].'
				                        <br><br>
				                        パスワード: '.$_POST['password'].'
				                        <br><br>

				                            ';

				        $mailguest->send();
				        //echo 'Message has been sent';
				        // header("Location: /fukushisystem/memberMaster/MemberSuccess");
				        
				    } catch (Exception $e) {
				        echo 'Message could not be sent.';
				        echo 'Mailer Error: ' . $mailguest->ErrorInfo;
				    }
						echo "<script>
								UpdateMemberMaster();
								function UpdateMemberMaster(){
							        var result = confirm('修正されました。メールへユーザー名とパスワードを送っていました。');
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
					//duplicate Email Messenger
					echo '<script>document.getElementById("email-duplicate").style.display = "block";</script>';
			}
		}else{
			// echo "<script>alert('unit');</script>";
			header("Location: /fukushisystem/memberMaster");
		}
	}
	function MemberSuccess(){
		require_once("./views/memberMasterList.html");
	}
	function UrlProcess(){
		if (isset($_GET['url'])) {
			return explode("/", filter_var(trim($_GET['url'], "/")));
		}
	}
}
?>
