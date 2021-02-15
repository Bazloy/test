<?php
	define(root, $_SERVER["DOCUMENT_ROOT"]);
	require_once root."/modules/admin/sessions.php";
	
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
define(root, $_SERVER["DOCUMENT_ROOT"]);

if(isset($_FILES['filename'])){
	
	$errors = array();
	$file_name = $_FILES['filename']['name'];
	$file_size = $_FILES['filename']['size'];
	$file_tmp = $_FILES['filename']['tmp_name'];
	$file_type = $_FILES['filename']['type'];
	$file_ext = strtolower(end(explode('.', $_FILES['filename']['type'])));
	
	//$expenstion = array("text/plain", "pdf");
	
	if($file_size > 20984748){
		
		$errors[] = 'Файл слишком большой';
		
	}
	
	if(empty($errors) == true){
		
		$put_f = root."/file/course/".$file_name;
		move_uploaded_file($file_tmp, $put_f);
		
		$put_f = "/file/course/".$file_name;
		$ID = $_POST['MaterialID'];
		
		$conn = mysqli_connect("localhost","root","","main"); 
		$sql = "SELECT fullname FROM course where Id = '$ID'";
		$result = $conn->query($sql); 
		while($row = mysqli_fetch_array($result)){ 
		
			$name = $row["fullname"];
			$succcseC = $conn->query ("INSERT INTO material (courseid, name, file) VALUES ('".$ID."', '".$name."', '".$put_f."')");
			
		}
		echo "<script>sucsess();</script>"; 
		
	}else{
		
		print $errors;
		
	}
	
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
			<h1>Курсы</h1>
			
			<table class="simple-little-table" cellspacing='0'>
			<tr>
			  <th class="th-sm">№
			  </th>
			  <th class="th-sm">Название
			  </th>
			  <th class="th-sm">Описание
			  </th>
			  <th class="th-sm">Добавить материал
			  </th>
			</tr>
			
			<?
			
			$conn = mysqli_connect("localhost","root","","main"); 

			$sql = "SELECT * FROM course";

			$result = $conn->query($sql); 

			  // output data of each row 
			while($row = mysqli_fetch_array($result)){ 

			  echo "<tr><td>" . $row["Id"]
					. "</td><td>" . $row["fullname"] 
					. "</td><td>" . $row["summary"]
					. "</td>";
				
				$MaterialID = $row['Id'];
				$courseID = $row['Id'];
			
			?>
			
                <td>
                    <form action="" method="post" enctype="multipart/form-data">
					  <input type="file" name="filename"><br> 
					  <input type="hidden" name="MaterialID" value="<?php echo $MaterialID; ?>"/>
					  <input type="submit" value="Загрузить"><br>
					</form>
                </td>
			
			<?
			}
			echo"</tr>"
			
			
			?>
			</table>
			
		</div>
		
		<div id="nav">
			<h2>Навигация</h2>
			<ul>
				<li><a href='admin.php'>Пользователи</a></li>
				<li><a href='course.php'>Курсы</a></li>
			</ul>
		</div>
	</body>
</html>