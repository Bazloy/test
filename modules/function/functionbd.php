<?php
$conn = mysqli_connect("localhost","root","","curs");

	$mysql = false;
	function conectDB(){
		global $mysql;
		$mysql = mysqli_connect("localhost","root","","curs"); 
		$mysql->query("SET NAMES 'utf8'");
	}

	function closeDB(){
		global $mysql;
		$mysql->close();
	}
	
?>