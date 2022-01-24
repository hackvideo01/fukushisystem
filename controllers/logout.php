<? 
require './config/define.php';
class logout{
	function welcome(){
		if (isset($_SESSION['usernameSS'])){
		unset($_SESSION['usernameSS']); // xóa session login
		header("Location: ".WEB_URL."login");
		}
		// if (isset($_SESSION['usernameSS2'])){
		// unset($_SESSION['usernameSS2']); // xóa session login
		// header('Location: ./login');
		// }
		header("Location: ".WEB_URL."login");
	}
}
?>
