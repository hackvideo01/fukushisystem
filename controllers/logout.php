<? 
class logout{
	function welcome(){
		if (isset($_SESSION['usernameSS'])){
		unset($_SESSION['usernameSS']); // xóa session login
		header('Location: ./login');
		}

	}
}
?>
