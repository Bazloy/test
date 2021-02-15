<?php
	define(root, $_SERVER["DOCUMENT_ROOT"]);
	require_once root."/modules/sessions.php";
	require_once root."/modules/function/functionbd.php";
	
	global $mysql;
	conectDB();
	$sql = "select * from user where Login='".htmlspecialchars($_POST['Login'])."'";
	$result = $mysql->query($sql);
	
	if($result->num_rows <= 0){
		
		echo "Логин/пароль введенны не верно"; 
		
	}else{
		
		while($row = mysqli_fetch_array($result)) {

			if(htmlspecialchars($_POST['Pass'] == "")){
				
				echo "Не введен пароль";
				
			}
			
			if($row["Pass"] == htmlspecialchars($_POST['Pass'])){
				
				setcookie("user_id", $row['Id'], time() + 1000);
				$_SESSION["user_id"] = $row['Id'];
				$_SESSION["user_login"] = $row['Login'];
				//echo $_COOKIE["user_id"];
				echo "Авторизация";
				//rederect_to("admin.php");
				
			}else{
				
				
				echo "Логин/пароль введенны не верно asdas "; 
				
			}
		}
		
	}
	
?>