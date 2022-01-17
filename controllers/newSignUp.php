<?
class newSignUp extends controller{
	function welcome(){
		include_once './views/newSignUp.html';
		if (isset($_POST['newSignUp'])) {
			echo "<script>alert('newSignUp');</script>";
			echo $_POST['email']."<br>";
			echo $_POST['username']."<br>";
			echo $_POST['password']."<br>";
			echo $_POST['firstname']."<br>";
			echo $_POST['lastname']."<br>";
			echo $_POST['radiogroup1'];
			

			header("Location: /fukushisystem/success");
		}
	}
}
?>