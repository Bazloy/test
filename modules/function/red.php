<?php
	define(root, $_SERVER["DOCUMENT_ROOT"]);
	require_once root."/modules/function/functionbd.php";
	
	global $mysql;
	conectDB();
	
	$sql = "UPDATE user 
	SET Login = '".htmlspecialchars($_POST['Login'])."',
	Pass = '".htmlspecialchars($_POST['Pass'])."', 
	Name = '".htmlspecialchars($_POST['Name'])."', 
	SurName = '".htmlspecialchars($_POST['SurName'])."', 
	City = '".htmlspecialchars($_POST['City'])."', 
	Email = '".htmlspecialchars($_POST['Email'])."'
	Where Id = '".htmlspecialchars($_POST['Id'])."'";
			
	if(mysqli_query($mysql, $sql)){
		echo "Данные успешно измененны"; 
	}else{
		echo "Error: " . $sql . "<br>" . mysqli_error($mysql);
	}

?>