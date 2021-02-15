<?php
	require_once root."/modules/function/functionbd.php";
	
	function selCount($sqlC){
		global $mysql;
		conectDB();
		$result = $mysql->query($sqlC);	
		closeDB();
		return count($result);
	}
	
	function selZap($limit, $offset){
		global $mysql;
		conectDB();
		$result = $mysql->query("SELECT * From news ORDER BY 'id' DESC LIMIT ".$limit." OFFSET ".$offset."");	
		closeDB();
		return resultToArray($result);
	}
	
	function selZapG($limit, $offset){
		global $mysql;
		conectDB();
		$result = $mysql->query("SELECT * From games ORDER BY 'id' DESC LIMIT ".$limit." OFFSET ".$offset."");	
		closeDB();
		return resultToArray($result);
	}
	
	function selZapGC($limit, $offset, $id){
		global $mysql;
		conectDB();
		$result = $mysql->query("SELECT * From games Where Cat = '".$id."' ORDER BY 'id' DESC LIMIT ".$limit." OFFSET ".$offset."");	
		closeDB();
		return resultToArray($result);
	}
	
	function selZapF($limit, $offset){
		global $mysql;
		conectDB();
		$result = $mysql->query("SELECT * From materials ORDER BY 'id' DESC LIMIT ".$limit." OFFSET ".$offset."");	
		closeDB();
		return resultToArray($result);
	}
	
	function selZapFC($limit, $offset, $id){
		global $mysql;
		conectDB();
		$result = $mysql->query("SELECT * From materials Where CatF = '".$id."' ORDER BY 'id' DESC LIMIT ".$limit." OFFSET ".$offset."");	
		closeDB();
		return resultToArray($result);
	}
	
	function selALL($sql){
		global $mysql;
		conectDB();
		$result = $mysql->query($sql);	
		closeDB();
		return resultToArray($result);
	}
	
	function resultToArray($result){
		$array = array();
		while(($row = mysqli_fetch_array($result)) != false){
			$array[] = $row;
		}
		return $array;
	}
	
	function LoadGame(){
		global $mysql;
		conectDB();
		$NamesGame = $_POST['NamesGame'];
		$Cat = $_POST['Cat'];
		$ShortDisc = $_POST['ShortDisc'];
		$Discript = $_POST['Discript'];
		$FileG = $_POST['FileG'];
		$IdUser = $_POST['ID'];
		if(isset($_FILES['FileG'])){
			$file_name = $_FILES['FileG']['name'];
			$file_tmp = $_FILES['FileG']['tmp_name'];
			
			$result = $mysql->query("SELECT * From categoryg Where Id = '".$Cat."'");	
			$res =  resultToArray($result);
			$put_f = root."/file/games/".$res[0]["FolderG"]."/".$file_name;

			move_uploaded_file($file_tmp, $put_f);
			
			$put_f = "/file/games/".$res[0]["FolderG"]."/".$file_name;
			
			$sql = "INSERT INTO games (NamesGame, Cat, ShortDisc, Discript, FileG, IdUser) 
			VALUES ('".$NamesGame."', '".$Cat."', '".$ShortDisc."', '".$Discript."', '".$put_f."', '".$IdUser."')";
				
			if(mysqli_query($mysql, $sql)){
				echo "<script>alert('Файл успешно загружен');</script>"; 
			}else{
				echo "<script>alert('Произошла ошибка при загрузки');</script>"; 
			}
		}
	}
	
	function LoadFile(){
		global $mysql;
		conectDB();
		$NamesFile = $_POST['NamesFile'];
		$CatF = $_POST['CatF'];
		$ShortDiscF = $_POST['ShortDiscF'];
		$DiscriptF = $_POST['DiscriptF'];
		$FileM = $_POST['FileM'];
		$IdUser = $_POST['ID'];
		if(isset($_FILES['FileM'])){
			$file_name = $_FILES['FileM']['name'];
			$file_tmp = $_FILES['FileM']['tmp_name'];
			
			$result = $mysql->query("SELECT * From categoryf Where Id = '".$CatF."'");	
			$res =  resultToArray($result);
			$put_f = root."/file/filesUser/".$res[0]["Folder"]."/".$file_name;

			move_uploaded_file($file_tmp, $put_f);
			
			$put_f = "/file/filesUser/".$res[0]["Folder"]."/".$file_name;
			
			$sql = "INSERT INTO materials (NamesFile, CatF, ShortDiscF, DiscriptF, FileM, IdUserM) 
			VALUES ('".$NamesFile."', '".$CatF."', '".$ShortDiscF."', '".$DiscriptF."', '".$put_f."', '".$IdUser."')";
				
			if(mysqli_query($mysql, $sql)){
				echo "<script>alert('Файл успешно загружен');</script>"; 
			}else{
				echo "<script>alert('Произошла ошибка при загрузки');</script>"; 
			}
		}
	}
	
?>