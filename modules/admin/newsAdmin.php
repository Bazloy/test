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

<SCRIPT LANGUAGE="JavaScript">
        
	function sucsess() {
		
        alert("Файл успешно загружен");
       
	} 
		
</SCRIPT>

<?php
require_once root."/modules/admin/newNews.php"; 

if(array_key_exists('buttonDob',$_POST)){
	
	echo first();
}

//echo require_once root."/modules/admin/newNews.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Панель администрирования</title>
		<meta charset="utf-8" >
		<link rel="stylesheet" href="/plugins/css/admin_style.css">
		<link rel="stylesheet" href="/plugins/css/styleForm.css">
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
			<h1>Новости</h1>
			
			<table class="simple-little-table" cellspacing='0'>
			<tr>
			  <th class="th-sm">№
			  </th>
			  <th class="th-sm">Заголовок
			  </th>
			  <th class="th-sm">Краткое описание
			  </th>
			  <th class="th-sm">Описанние
			  </th>
			  <th class="th-sm">Изображение
			  </th>
			  <th class="th-sm">Редактировать
			  </th>
			  <th class="th-sm">Удалить
			  </th>
			</tr>
			
			<?php
			
				$conn = mysqli_connect("localhost","root","","curs"); 

				$sql = "SELECT * FROM news";

				$result = $conn->query($sql);

				while($row = mysqli_fetch_array($result)){ 

				  echo "<tr><td>" . $row["Id"]
						. "</td><td>" . $row["Headline"] 
						. "</td><td>" . $row["ShortDescription"]
						. "</td><td>" . $row["Description"]
						. "</td><td>" . $row["ImageF"]
						. "</td><td> <a href='?red=". $row["Id"]."'> Редактировать"
						. "</td><td> <a href='?del=". $row["Id"]."'> Удалить"
						. "</td>";	

				}						
			
			?>
			
			</table>
			
			
			<div class="text-center">
				<button id="newNews">Добавить новость</button>
			</div>			

			
			<div id="createNews" class="createNews">
			
				<div class="modalCon">
				
					<span class="close" >&times;</span>
					<h1 class="h1Form"> Добавление новостей </h1>
					<form class="formForm" action="" method="POST" enctype="multipart/form-data">
						<div class="formGroup">
							<label for="">Заголовок</label>
							<input type="text" class="inputForm" name="Headline" id="Headline" placeholder="Заголовок новости" value="<?php $val1?>">
						</div>
						<div class="formGroup">
							<label for="">Краткое описание</label>
							<input type="text" class="inputForm" name="ShortDescription" id="ShortDescription" placeholder="краткое описание новости">
						</div>
						<div class="formGroup">
							<label for="">Текст</label>
							<textarea class="inputForm" name="Description" id="Description" placeholder="Текст новости"></textarea>
						</div>
						<div class="formGroup">
							<label for="">Загрузить изображение</label>
							<input type="file" name="Image" id="Image" class="inputForm"><br>
						</div>
						<div class="formGroup">
							<center><input class="buttonForm" type="submit" name="buttonDob" id="buttonDob" value="Добавить" /></center>
						</div>
					</form>
				
				</div>
			
			</div>
			
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
		
		<script src="/plugins/js/adminJs.js"></script>
	</body>
</html>