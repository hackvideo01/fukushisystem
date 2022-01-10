<? 
class logout{
	function welcome(){
		if (isset($_SESSION['usernameSS1'])){
		unset($_SESSION['usernameSS1']); // xóa session login
		header('Location: ./login');
		}
		if (isset($_SESSION['usernameSS2'])){
		unset($_SESSION['usernameSS2']); // xóa session login
		header('Location: ./login');
		}
	}
}
?>
