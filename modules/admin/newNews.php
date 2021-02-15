<?php

$val1 = "asdasdasdasd";

$conn = mysqli_connect("localhost","root","","curs");

if(isset($_GET['del'])){
	
	$id = $_GET['del'];
	$sql = "DELETE From news Where Id = '".$id."'";
	
	if(mysqli_query($conn, $sql)){
		
		//echo "<script>alert('Файл успешко загружен');</script>"; 
		
	}else{
		
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
} 

if(isset($_GET['red'])){
	
	$id = $_GET['red'];
	$sql = "Select * From news Where Id = '".$id."'";
	
	if(mysqli_query($conn, $sql)){
		
		$result = $conn->query($sql);
		$rowRed = mysqli_fetch_array($result);
		echo $row["Headline"];
		
	}else{
		
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
} 

function first(){
	
	define(root, $_SERVER["DOCUMENT_ROOT"]);
	require_once root."/modules/sessions.php";

	$Headline = $_POST['Headline'];
	$ShortDescription = $_POST['ShortDescription'];
	$Description = $_POST['Description'];
	$Image = $_POST['Image'];
	
	if(isset($_FILES['Image'])){
		
		$file_name = $_FILES['Image']['name'];
		$file_size = $_FILES['Image']['size'];
		$file_tmp = $_FILES['Image']['tmp_name'];
		$file_type = $_FILES['Image']['type'];
		
		$put_f = root."/file/news/".$file_name;
		move_uploaded_file($file_tmp, $put_f);
		
		$put_f = "/file/news/".$file_name;
		
	}
	
	if($put_f == "/file/news/"){
		
		$put_f = "/file/news/nulNews.png";
		
	}
	
	$conn = mysqli_connect("localhost","root","","curs");	
	$sql = "INSERT INTO news (Headline, ShortDescription, Description, ImageF) VALUES ('".$Headline."', '".$ShortDescription."', '".$Description."', '".$put_f."')";
		
	if(mysqli_query($conn, $sql)){
		
		echo "<script>alert('Новость успешно создана');</script>"; 
		
	}else{
		
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	

		
}

?>