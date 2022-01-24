<?
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		use PHPMailer\PHPMailer\SMTP;
		require './PHPMailer/src/Exception.php';
	    require './PHPMailer/src/PHPMailer.php';
	    require './PHPMailer/src/SMTP.php';
	    
class newSignUp extends controller{
	public function welcome(){
		
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("users");
		$_SESSION['dataSS'];
		$dataSave = [];
	    if (isset($_POST['newSignUpCheck'])) {
	    	$queryCount =  'SELECT COUNT(*) AS `total` FROM `users` WHERE `username` = "'.$_REQUEST["username"].'"';
			$countItem = $database->fetchRow($queryCount)['total'];

			$queryCountEmail =  'SELECT COUNT(*) AS `total` FROM `users` WHERE `email` = "'.$_REQUEST["email"].'"';
			$countItemEmail = $database->fetchRow($queryCountEmail)['total'];
			if ($countItem == 0 && $countItemEmail == 0) {
				$dataSave = array(
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
				$_SESSION['dataSS'] = $dataSave;
				$listItem = $_SESSION['dataSS'];
				$comfirm = 1;
			}
	    }
	    include_once './views/newSignUp.html';
		if (isset($_POST['newSignUp'])) {
			$_SESSION['email'] = $_POST['email'];

		    if ($_POST['email']!=""&&$_POST['username']!=""&&$_POST['password']!=""&&$_POST['CompanyName']!="") {
				$queryCount =  'SELECT COUNT(*) AS `total` FROM `users` WHERE `username` = "'.$_REQUEST["username"].'"';
				$countItem = $database->fetchRow($queryCount)['total'];

				$queryCountEmail =  'SELECT COUNT(*) AS `total` FROM `users` WHERE `email` = "'.$_REQUEST["email"].'"';
				$countItemEmail = $database->fetchRow($queryCountEmail)['total'];

				if ($countItem == 0 && $countItemEmail == 0) {
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
					$database->insert($data);

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
			        header("Location: /fukushisystem/newSignUp/Success");
			        
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
			    echo '<script>document.getElementById("need-haved").style.display = "block";</script>';
			}
			    
			}

			// header("Location: /fukushisystem/success");
			return $email;
	}
	function Success(){
		include_once './views/success.html';
		unset($_SESSION['email']);
	}
}
?>