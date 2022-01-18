<?
class login extends controller{
	function welcome(){
		$db = $this->model("database");
		$_SESSION["usernameSS"]=NULL;
		$access = $_GET['access'];

		if (isset($_POST['login'])) {

			if($_SESSION["usernameSS"]==NULL){
				$database = new Database();
				
				if ($_SERVER['REQUEST_METHOD'] == 'POST'){

						$query[] = 'SELECT * FROM users WHERE username="'.$_REQUEST["username"].'"AND password="'.$_REQUEST["password"].'"';
						$query = implode("",$query);
						$list = $database->fetchAll($query);
						
						if($list){
							// if (!empty($list)) {
							//     foreach ($list as $item) {
							//         echo '<pre style="color:red;font-weight:bold">';
							//         print_r($list);
							//         echo '</pre>';
							//         echo $item['Id'];
							//     }
							// }
							
							foreach ($list as $value) {
								$_SESSION['usernameSS'] = $value['username'];
								$_SESSION['role']		= $value['role'];
							}
							if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==1) {
								header('Location: ./userMNMT');
							}else if (isset($_SESSION['usernameSS'])&&$_SESSION['role']==0) {
								header('Location: ./unit');
							}
							
							return true;
						}else{
							$error_info = "ユーザ名、パスワードが間違っています。";
							echo '
								<div style="text-align:center;color:white;font-weight:bold;">
									<span>'.$error_info.'</span>
								</div>	
							 	';
							// return false;
						}
				}
				// return false;
			}
		}

		if (isset($_POST["login-office"])) {
			if($_SESSION["usernameSS1"]==NULL){
				$database = new Database();
				
				if ($_SERVER['REQUEST_METHOD'] == 'POST'){
						$query[] = 'SELECT * FROM users WHERE username="'.$_REQUEST["username"].'"AND password="'.$_REQUEST["password"].'" AND role=1';
						$query = implode("",$query);
						$list = $database->fetchAll($query);
						// echo $query;
						// exit();
						if($list){
							// if (!empty($list)) {
							//     foreach ($list as $item) {
							//         echo '<pre style="color:red;font-weight:bold">';
							//         print_r($list);
							//         echo '</pre>';
							//         echo $item['Id'];
							//     }
							// }
							foreach ($list as $value) {
								$_SESSION['usernameSS1'] = $value;
							}
							header('Location: ./userMNMT');
							return true;
						}else{
							$error_info = "ユーザ名、パスワードが間違っています。";
							echo '
								<div style="text-align:center;color:white;font-weight:bold;">
									<span>'.$error_info.'</span>
								</div>	
							 	';
							// return false;
						}
				}
				// return false;
			}
		}elseif (isset($_POST["login-operation"])) {
			if($_SESSION["usernameSS2"]==NULL){
				$database = new Database();
				
				if ($_SERVER['REQUEST_METHOD'] == 'POST'){
						$query[] = 'SELECT * FROM users WHERE username="'.$_REQUEST["username"].'"AND password="'.$_REQUEST["password"].'"AND role=0';
						$query = implode("",$query);
						$list = $database->fetchAll($query);
						if($list){

							// if (!empty($list)) {
							//     foreach ($list as $item) {
							//         echo '<pre style="color:red;font-weight:bold">';
							//         print_r($list);
							//         echo '</pre>';
							//         echo $item['Id'];
							//     }
							// }
							foreach ($list as $value) {
								$_SESSION['usernameSS2'] = $value;
							}
							header('Location: ./municipality');
							return true;
						}else{
							$error_info = "ユーザ名、パスワードが間違っています。";
							echo '
								<div style="text-align:center;color:white;font-weight:bold;">
									<span>'.$error_info.'</span>
								</div>	
							 	';
							// return false;
						}
				}
				// return false;
			}
		}

		
		if($_SESSION["usernameSS1"]!=NULL ){
			header('Location: ./userMNMT');
		}
		if($_SESSION["usernameSS2"]!=NULL ){
			header('Location: ./municipality');
		}
		include_once './views/login.html';
	}
}
?>