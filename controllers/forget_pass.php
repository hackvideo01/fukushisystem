<?
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		use PHPMailer\PHPMailer\SMTP;
		require './PHPMailer/src/Exception.php';
	    require './PHPMailer/src/PHPMailer.php';
	    require './PHPMailer/src/SMTP.php';
	    require './config/define.php';
	    
class forget_pass extends controller{
	public function welcome(){
		include_once './views/forget_pass.html';
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("users");
		$token = '';
		$token_after = '';
		$link = '';
		$username = '';
		$PATH_PASS = WEB_URL;
		if (isset($_POST['forgetPass'])) {
			$_SESSION['email'] = $_POST['email'];

		    if ($_POST['email']!="") {
				// echo "<script>alert('newSignUp');</script>";
				// echo $_POST['email']."<br>";
				// echo $_POST['username']."<br>";
				// echo $_POST['password']."<br>";
				// echo $_POST['firstname']."<br>";
				// echo $_POST['lastname']."<br>";
				// echo $_POST['radiogroup1'];
				// $query[] = 'SELECT * FROM users WHERE username="'.$_REQUEST["username"].'"AND password="'.$_REQUEST["password"].'"';
				// $queryCount =  'SELECT COUNT(*) AS `total` FROM `users` WHERE `username` = "'.$_REQUEST["username"].'"AND role=1';

				$queryCount[] = 'SELECT COUNT(*) AS `total` FROM `users` WHERE ';
				$queryCount[] = "email = '".$_POST['email']."'";
				$queryCount = implode(" ",$queryCount);
				$countItem = $database->fetchRow($queryCount)['total'];
				
				if ($countItem == 1) {
			        $query[] = 'SELECT * FROM users WHERE email="'.$_REQUEST["email"].'"';
					$query = implode("",$query);
					$list = $database->fetchAll($query);

					
					if ($list) {
						foreach ($list as $value) {
							$token_before = $value['token'];
							$token_after = password_hash($value['token'], PASSWORD_DEFAULT);
							$username = $value['username'];
						}
					}
				$pass_verify = password_verify($token_before , $token_after);
				$link = "forget_pass/forget_pass_reset&username=".$username."&email=".$_POST['email']."&token=".$token_after;
			    $mailguest = new PHPMailer(true);                              // Passing `true` enables exceptions
			    try {
			        //Server settings
			        // $mailguest->SMTPDebug = 3;                                 // Enable verbose debug output
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
			        $mailguest->Subject = '福祉サービスーパスワード再発行';
			        $mailguest->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
			        $mailguest->Body    = ''.$_POST['email'].'　様<br>
			                        <br><br>

			                        アカウント名: '.$username.'
			                        <br><br>

			                        パスワード再発行のリンク：'.$PATH_PASS.''.$link.'
			                        <br><br>
			                            ';

			        $mailguest->send();
			        //echo 'Message has been sent';
			        // header("Location: /fukushisystem/forget_pass/Success");
			        echo '<script>;
							alert("登録されているメールアドレスにパスワード再発行手続きのURLをお送りいたしました。");
						  </script>';
			    } catch (Exception $e) {
			        echo 'Message could not be sent.';
			        echo 'Mailer Error: ' . $mailguest->ErrorInfo;
			    }
			    }else{
						echo '<script>document.getElementById("duplicate").style.display = "block";</script>';
					}

			    // $mailmanager = new PHPMailer(true);                              // Passing `true` enables exceptions
			    // try {
			    //     //Server settings
			    //     $mailmanager->SMTPDebug = 2;                                 // Enable verbose debug output
			    //     $mailmanager->isSMTP();                                      // Set mailer to use SMTP
			    //     $mailmanager->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			    //     $mailmanager->SMTPAuth = true;                               // Enable SMTP authentication
			    //     $mailmanager->Username = 'hackvideo01@gmail.com';                 // SMTP username
			    //     $mailmanager->Password = 'motthoihoankim';                           // SMTP password
			    //     $mailmanager->SMTPSecure = 'TLS';                           // Enable TLS encryption, `ssl` also accepted
			    //     $mailmanager->Port = 587;                                    // TCP port to connect to
			    //     $mailmanager->CharSet = "UTF-8";

			    //     //Recipients
			    //     $mailmanager->setFrom('hackvideo01@gmail.com','福祉システム');
			    //     $mailmanager->addAddress('hackvideo01@gmail.com');     // Add a recipient



			    //     //Content
			    //     $mailmanager->isHTML(true);                                  // Set email format to HTML
			    //     $mailmanager->Subject = 'ホームページより問い合わせがありました';
			    //     $mailmanager->Body    = '以下の内容でお客様から問い合わせをいただきました。
			    //                       <br><br>

			    //                       【お客様入力内容】
			    //                       <br><br>

			    //                       お名前: '.$_POST['namehira'].'
			    //                       <br><br>

			    //                       お名前カナ: '.$_POST['namekana'].'
			    //                       <br><br>

			    //                       会社名: '.$_POST['companyname'].'
			    //                       <br><br>

			    //                       メールアドレス: '.$_POST['email'].'
			    //                       <br><br>

			    //                       電話番号: '.$_POST['tel'].'
			    //                       <br><br>

			    //                       ご住所: '.$_POST['address'].'
			    //                       <br><br>

			    //                       お問い合わせ内容: '.$_POST['comment'].'
			    //                       <br><br>

			    //                         ';

			    //     $mailmanager->send();
			    //     //echo 'Message has been sent';

			    //     header("Location: ?id=3");
			    //     exit();
			        
			    // } catch (Exception $e) {
			    //     echo 'Message could not be sent.';
			    //     echo 'Mailer Error: ' . $mailmanager->ErrorInfo;
			    // }

			}else{
			    echo '<script>document.getElementById("need").style.display = "block";</script>';
			}
			    
			}

			// header("Location: /fukushisystem/success");
			return $email;
	}
	function forget_pass_reset(){
		include_once './views/forget_pass_reset.html';
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("users");
		$pass_verify;

		$query[] = 'SELECT * FROM users WHERE username="'.$_GET['username'].'"AND email="'.$_GET["email"].'"';
		$query = implode("",$query);
		$list = $database->fetchAll($query);
		if ($list) {
			foreach ($list as $value) {
				$pass_verify = password_verify($value['token'] , $_GET['token']);
			}
		}
		
		if ($pass_verify == 1 && $_POST['password'] != '' && $_POST['confirm_password'] != '') {
			$data = array(
				'password' 		=> $_POST["password"]
			);
			$list =  $database->update($data, array(['username', $_GET['username']]));
			header("Location: ".WEB_URL."forget_pass/Success_NewPass");
		}else{
			 echo '<script>document.getElementById("password-empty").style.display = "block";</script>';
		}
	}
	function Success(){
		include_once './views/forget_pass_success.html';
		unset($_SESSION['email']);
	}

	Function Success_NewPass(){
		include_once './views/Success_NewPass.html';
	}
}
?>