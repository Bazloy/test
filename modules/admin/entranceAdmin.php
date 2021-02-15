<?php

	function rederect_to($new_loc){
		header("Location: ".$new_loc);
		exit;
	}
	define(root, $_SERVER["DOCUMENT_ROOT"]);
	require_once root."/modules/sessions.php";
	
$login = "";

//echo htmlentities($_SESSION["admin_id"]);
if(isset($_POST['submit'])){
	
	$conn = new mysqli ("localhost","root","","curs");
	
	$sql = ("SELECT * FROM user_admin where Login = '".$_POST['login']."'");
	$result = $conn->query($sql);

	if($result->num_rows <= 0){
		
		echo "<script>alert('Логин/пароль введенны не верно');</script>"; 
		
	}else{
		
		while($row = mysqli_fetch_array($result)) {

			if($_POST['pass'] == ""){
				
				echo "<script>alert('Не введен пароль');</script>";
				
			}
			
			if($row["Pssword"] == $_POST['pass']){
				
				$_SESSION["admin_id"] = $row['Id'];
				$_SESSION["admin_login"] = $row['Login'];
				rederect_to("admin.php");
				
			}else{
				
				echo "<script>alert('Логин/пароль введенны не верно');</script>"; 
				
			}
		}
		
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Панель администрирования</title>
		<meta charset="utf-8" >
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="/plugins/css/admin_style.css">
	</head>
	<body>
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title" id="loginModal">Вход в панель администратора</h4>
				</div>
				
				<div class="modal-body">
				
					<div class="alert alert-primary" id="auth_alert" style="display:none;" role="alert"></div>
					
					<form action="entranceAdmin.php" method="POST">
						<div class="form-group row">
							<label for="login" class="col-sm-2 col-form-label">Логин</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" value="<?php echo htmlentities($login); ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="pass" class="col-sm-2 col-form-label">Пароль</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="pass" id="pass" placeholder="Введите логин">
							</div>
						</div>
						<br>
						<div class="text-center">
							<input name="submit" type="submit" value="Войти в аккаунт"></button>
						</div>
					</form>
		  
				</div>
			</div>
		</div>
	</body>
</html>