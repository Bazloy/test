<?php
	define(root, $_SERVER["DOCUMENT_ROOT"]);
	require_once root."/modules/sessions.php";
	
	if(!$_SESSION["admin_id"]){
		
		rederect_to("entranceAdmin.php"); 
		
	}
	
	function rederect_to($new_loc){
		header("Location: ". $new_loc);
		exit;
	}
	
?>



<?php

if(isset($_POST['submit'])){
	
	$_SESSION["admin_id"] = null;
	$_SESSION["admin_login"] = null;
	rederect_to("entranceAdmin.php");
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Панель администрирования</title>
		<meta charset="utf-8" >
		<link rel="stylesheet" href="/plugins/css/admin_style.css">
	</head>
	<body>
		<div id="header" class = "container4">
			<p>Административная панель
			<div>
			<form action="admin.php" method="POST">
				<div class="text-center">
					<input name="submit" type="submit" value="Выход"></button>
				</div>
			</form>
			</div>
		</div>

		<div id="content">
			<h1>Пользователи</h1>
			<table class="simple-little-table" cellspacing='0'>
			<tr>
			  <th class="th-sm">№
			  </th>
			  <th class="th-sm">Логин
			  </th>
			  <th class="th-sm">Фамилия
			  </th>
			  <th class="th-sm">Имя
			  </th>
			  <th class="th-sm">Email
			  </th>
			  <th class="th-sm">Пароль
			  </th>
			</tr>
			
			<?
			
			$conn = mysqli_connect("localhost","root","","curs");

			$sql = "SELECT * FROM user";

			$result = $conn->query($sql); 
			if ($result->num_rows > 0) { 

			  // output data of each row 
			while($row = $result->fetch_assoc()) { 

			  echo "<tr><td>" . $row["Id"]
					. "</td><td>" . $row["Login"] 
					. "</td><td>" . $row["Name"]
					. "</td><td>" . $row["Surname"]
					. "</td><td>" . $row["Email"]
					. "</td><td>" . $row["Pass"]
					. "</td></tr>"; 
				
			} 

			}
			
			?>
			
			</table>
		</div>
		<div id="nav">
			<h2>Навигация</h2>
			<ul>
				<li><a href='admin.php'>Пользователи</a></li>
				<li><a href='course.php'>Курсы</a></li>
				<li><a href='newsAdmin.php'>Новости</a></li>
				<li><a href='filesAdmin.php'>Файлы</a></li>
			</ul>
		</div>
	</body>
</html>