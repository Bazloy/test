<?php
	define(root, $_SERVER["DOCUMENT_ROOT"]);
	require_once root."/modules/function/functionbd.php";
	//echo "Регистрация прошла успешно";
	
	//function regNewUser(){

	
	
		global $mysql;
		conectDB();
		$sql = "select Login from user where Login='".htmlspecialchars($_POST['Login'])."'";
		$result = $mysql->query($sql);
		$newLogin = false;
		
		if($result->num_rows <= 0){
			
			$sql = "INSERT INTO user (Login, Pass, Name, SurName, City, Email) VALUES 
			('".htmlspecialchars($_POST['Login'])."',
			'".htmlspecialchars($_POST['Pass'])."
			','".htmlspecialchars($_POST['Name'])."
			','".htmlspecialchars($_POST['SurName'])."
			','".htmlspecialchars($_POST['City'])."
			','".htmlspecialchars($_POST['Email'])."')";
			
			if(mysqli_query($mysql, $sql)){
				
				echo "Регистрация прошла успешно"; 
				
			}else{
				
				echo "Error: " . $sql . "<br>" . mysqli_error($mysql);
			}
			
		}else{
			
			while($row = mysqli_fetch_array($result)){ 
			
				if($row["Login"] == htmlspecialchars($_POST['Login'])){
					$newLogin = false;
					break;
				}else{
					$newLogin = true;
				}
				
			}
			
			if($newLogin){
				
				$sql = "INSERT INTO user (Login, Pass, Name, SurName, City, Email) VALUES 
				('".htmlspecialchars($_POST['Login'])."','".htmlspecialchars($_POST['Pass'])."
				','".htmlspecialchars($_POST['Name'])."
				','".htmlspecialchars($_POST['SurName'])."
				','".htmlspecialchars($_POST['City'])."
				','".htmlspecialchars($_POST['Email'])."')";
				
				if(mysqli_query($mysql, $sql)){
					
					echo "Регистрация прошла успешно"; 
					
				}else{
					
					echo "Error: " . $sql . "<br>" . mysqli_error($mysql);
				}
				
			}else{
				echo "Такой логин уже существует"; 
			}
			
		}
	
	//}

?>