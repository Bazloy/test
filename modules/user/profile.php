<?php
define(root, $_SERVER["DOCUMENT_ROOT"]);
require_once root."/modules/sessions.php";
?>

<?php
require_once root."/modules/function/function.php";

if(array_key_exists('ZagGamesF',$_POST)){
	
	echo LoadGame();
}

if(array_key_exists('zagMatBF',$_POST)){
	
	echo LoadFile();
}

if(isset($_GET['del'])){
	
	$id = $_GET['del'];
	$sql = "DELETE From games Where Id = '".$id."'";
	
	if(mysqli_query($conn, $sql)){
		
		//echo "<script>alert('Файл успешко загружен');</script>"; 
		
	}else{
		
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
} 

if(isset($_GET['delM'])){
	
	$id = $_GET['delM'];
	$sql = "DELETE From materials Where Id = '".$id."'";
	
	if(mysqli_query($conn, $sql)){
		
		//echo "<script>alert('Файл успешко загружен');</script>"; 
		
	}else{
		
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
} 

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<?php
    require_once root."/modules/html/head_meta.php";
	$id = $_SESSION["user_id"];
	$sql = "SELECT * From user Where Id = '$id'";
	$user = selALL($sql);
	
	
    ?>
</head>
<body>

	<header>
		<div id="logo" onclick="slowScroll('#top')">
			<span>Разработчики</span>
		</div>
		
		<?php
			require_once root."/modules/html/menu.php";
		?>
		
	</header>
	
	<div id="top_2">
		<h1>Добро пожаловать <?php echo $user[0]["Login"]; ?></h1>
	</div>
	
	
	<div id="RegistrationT">
	
		<div id="TableF">
			<h1>Игры</h1>
			<table class="simple-little-table" cellspacing='0'>
			<tr>
				<th class="th-sm">№
				</th>
				<th class="th-sm">Название
				</th>
				<th class="th-sm">Категория
				</th>
				<th class="th-sm">Краткое описание
				</th>
				<th class="th-sm">Описание
				</th>
				<th class="th-sm">Удалить
				</th>
			</tr>
				
				<?php
					$sql = "SELECT * From games Where IdUser = '".$_SESSION["user_id"]."'";
					$GamesUs = selALL($sql);
					for($i = 0; $i < count($GamesUs); $i++){
						$sql = "SELECT * From categoryg Where Id = '".$GamesUs[$i]["Cat"]."'";
						$catGT = selALL($sql);
						echo "<tr><td>" . ($i+1)
							. "</td><td>" . $GamesUs[$i]["NamesGame"] 
							. "</td><td>" . $catGT[0]["NameCatG"]
							. "</td><td>" . $GamesUs[$i]["ShortDisc"]
							. "</td><td>" . $GamesUs[$i]["Discript"]
							. "</td><td> <a href='?del=". $GamesUs[$i]["Id"]."'> Удалить"
							. "</td></tr>";
					}
				
				?>
				
			</table>
		
			<h1>Материлы</h1>
			<table class="simple-little-table" cellspacing='0'>
			<tr>
				<th class="th-sm">№
				</th>
				<th class="th-sm">Название
				</th>
				<th class="th-sm">Категория
				</th>
				<th class="th-sm">Краткое описание
				</th>
				<th class="th-sm">Описание
				</th>
				<th class="th-sm">Удалить
				</th>
			</tr>
				
				<?php
					$sql = "SELECT * From materials Where IdUserM = '".$_SESSION["user_id"]."'";
					$MatUs = selALL($sql);
					for($i = 0; $i < count($MatUs); $i++){
						$sql = "SELECT * From categoryf Where Id = '".$MatUs[$i]["CatF"]."'";
						$catMat = selALL($sql); 
						echo "<tr><td>" . ($i+1)
							. "</td><td>" . $MatUs[$i]["NamesFile"] 
							. "</td><td>" . $catMat[0]["NameCatF"]
							. "</td><td>" . $MatUs[$i]["ShortDiscF"]
							. "</td><td>" . $MatUs[$i]["DiscriptF"]
							. "</td><td> <a href='?delM=". $MatUs[$i]["Id"]."'> Удалить"
							. "</td></tr>";
					}
				
				?>
				
			</table>
			
		</div>
	
		<form id="regFormD" action="" method="POST" style="display: none;">
			<h1> Изменение данных</h1>
			<label for="Login">Логин</label><br>
			<input class="regFormInput" type="text" placeholder="Ваш логин" name="Login" id="Login" value="<?php echo $user[0]["Login"]; ?>"><br>
			<label for="Pass">Пароль</label><br>
			<input class="regFormInput" type="password" placeholder="Введите пароль" name="Pass" id="Pass" value="<?php echo $user[0]["Pass"]; ?>"><br>
			<label for="Name">Имя</label><br>
			<input class="regFormInput" type="text" placeholder="Ваше имя" name="Name" id="Name" value="<?php echo $user[0]["Name"]; ?>"><br>
			<label for="SurName">Фамилия</label><br>
			<input class="regFormInput" type="text" placeholder="Ваша фамилия" name="SurName" id="SurName" value="<?php echo $user[0]["SurName"]; ?>"><br>
			<label for="Email">Электронная почта</label><br>
			<input class="regFormInput" type="text" placeholder="Ваша электронная почта" name="Email" id="Email" value="<?php echo $user[0]["Email"]; ?>"><br>
			<label for="City">Город</label><br>
			<input class="regFormInput" type="text" placeholder="Ваш город" name="City" id="City" value="<?php echo $user[0]["City"]; ?>"><br>
			<input type="text" name="ID" id="ID" value="<?php echo $_SESSION["user_id"]; ?>" style = "display: none"><br>
			<div id="messegeShow"></div>
			<center><input class="RegBtn" type="button" name="RegInformP" id="RegInformP" value="Изменть данные" /></center>
			<br>
		</form>
		
		<form id="zagGameF" action="" method="POST" style="display: none;" enctype="multipart/form-data">
			<h1>Загрузка игры</h1>
			<label for="NamesGame">Название игры</label><br>
			<input class="regFormInput" type="text" placeholder="Название игры" name="NamesGame" id="NamesGame"><br>
			<label for="Cat">Категория игры</label><br>
			<select class="regFormInput" name="Cat" id="Cat">
			<?php
				for($i = 0; $i < count($cat); $i++){
					echo "<option value='".$cat[$i]["Id"]."'>".$cat[$i]["NameCatG"]."</option>";
				}
			?>
			</select> <br>
			<label for="ShortDisc">Краткое описние</label><br>
			<input class="regFormInput" type="text" placeholder="Краткое описние" name="ShortDisc" id="ShortDisc"><br>
			<label for="Discript">Описание</label><br>
			<textarea class="regFormInputAR" name="Discript" id="Discript" placeholder="Описние"></textarea><br>
			<label for="FileG">Файл игры</label><br>
			<input class="regFormInput" type="file" name="FileG" id="FileG"><br>
			<input type="text" name="ID" id="ID" value="<?php echo $_SESSION["user_id"]; ?>" style = "display: none"><br>
			<div id="messegeShow"></div>
			<center><input class="RegBtn" type="submit" name="ZagGamesF" id="ZagGamesF" value="Загрузить игру" /></center>
			<br>
		</form>
		
		<form id="zagMatF" action="" method="POST" style="display: none;" enctype="multipart/form-data">
			<h1>Загрузка материалов</h1>
			<label for="NamesFile">Название файла</label><br>
			<input class="regFormInput" type="text" placeholder="Название игры" name="NamesFile" id="NamesFile"><br>
			<label for="CatF">Категория файла</label><br>
			<select class="regFormInput" name="CatF" id="CatF">
			<?php
				for($i = 0; $i < count($catf); $i++){
					echo "<option value='".$catf[$i]["Id"]."'>".$catf[$i]["NameCatF"]."</option>";
				}
			?>
			</select> <br>
			<label for="ShortDiscF">Краткое описние</label><br>
			<input class="regFormInput" type="text" placeholder="Краткое описние" name="ShortDiscF" id="ShortDiscF"><br>
			<label for="DiscriptF">Описание</label><br>
			<textarea class="regFormInputAR" name="DiscriptF" id="DiscriptF" placeholder="Описние"></textarea><br>
			<label for="FileM">Файл</label><br>
			<input class="regFormInput" type="file" name="FileM" id="FileM"><br>
			<input type="text" name="ID" id="ID" value="<?php echo $_SESSION["user_id"]; ?>" style = "display: none"><br>
			<div id="messegeShow"></div>
			<center><input class="RegBtn" type="submit" name="zagMatBF" id="zagMatBF" value="Загрузить материал" /></center>
			<br>
		</form>
	</div>
	
	<div class="HeadDivN">
		<nav class="dwsMenu">
			<ul>
				<li><input class="VBtn" type="button" name="RedInform" id="RedInform" value="Редактировать информацию"  /></li>
				<li><input class="VBtn" type="button" name="ZagGames" id="ZagGames" value="Загрузить игры"  /></li>
				<li><input class="VBtn" type="button" name="ZagInform" id="ZagInform" value="Загрузить файлы"  /></li>
				<li><input class="VBtn" type="button" name="MyFile" id="MyFile" value="Мои файлы"  /></li>
			</ul>
	</div>
	
<?php

require_once root."/modules/html/footer.php";
?>