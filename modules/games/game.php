<?php
define(root, $_SERVER["DOCUMENT_ROOT"]);
require_once root."/modules/sessions.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
	<?php
		
    require_once root."/modules/html/head_meta.php";
	
	$catS = $_GET['cat'];
		
	if($catS == null){
		$Zag = "Игры";
		$page = isset($_GET['pageG']) ?  $_GET['pageG']:1;
		$limt = 3;
		$offset = $limt * ($page - 1);
		$games = selZapG($limt, $offset);
		$sqlC = "SELECT * From games";
		$pageCount = selCount($sqlC);		
	}else{
		$sql = "SELECT * From categoryg Where Id = '".$catS."'";
		$catGT = selALL($sql); 
		$Zag = $catGT[0]["NameCatG"];
		$page = isset($_GET['pageG']) ?  $_GET['pageG']:1;
		$limt = 3;
		$offset = $limt * ($page - 1);
		$games = selZapGC($limt, $offset, $catS);
		$sqlC = "SELECT * From games";
		$pageCount = selCount($sqlC);
		
		if(count($games) == 0){
			$Zag = "В данной категории нет еще не одной игры"; 
		}
		
	}
	
	
	
    ?>
	<title>Сайт разработчиков игр</title>
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
		<h1> <?php echo $Zag;?> </h1>
	</div>
	<?php
		for($i = 0; $i < count($games); $i++){
			$sql = "SELECT * From user Where Id = '".$games[$i]["IdUser"]."'";
			$userName = selALL($sql);
			echo "<div class='bigArtaicle'>
			<h2>".$games[$i]["NamesGame"]."</h2>
			<img src=".$games[$i]["FileG"]." alt=".$games[$i]["NamesGame"]." title=".$games[$i]["NamesGame"].">
			<p>".$games[$i]["ShortDisc"]."</p>
			<p>Автор: ".$userName[0]["Name"]."</p>
			<a href='/modules/games/bigGame.php?id=".$games[$i]["Id"]."&cat=".$catS."&news=".$i."'>
				<div>Далее</div>
			</a>
			</div>";
		}
	?>
	
	<div class="HeadDiv">
		<nav class="dwsMenu">
			<ul>
				<?php if($page > 1){$PageL = $page - 1; echo "<li><a href='/modules/games/game.php?pageG=".$PageL."&cat=".$catS."'><i class='fa fa-reply'></i>Предыдущя</a></li>";}?>
				<li><a href='/modules/games/game.php'><i class="fa fa-newspaper-o"></i>Все игры</a></li>
				<?php if($pageCount - $offset > 0){$PageN = $page + 1; echo "<li><a href='/modules/games/game.php?pageG=".$PageN."&cat=".$catS."'><i class='fa fa-share'></i>Следующая</a></li>";}?>
			</ul>
		</nav>
	</div>
	
<?php

require_once root."/modules/html/footer.php";
?>