<?php
define(root, $_SERVER["DOCUMENT_ROOT"]);
require_once root."/modules/sessions.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<?php
    require_once root."/modules/html/head_meta.php";
	$catS = $_GET['cat'];
	$news = $_GET['news'];
	$limt = 1;
	$sql = "SELECT * From games Where Id = '".$_GET["id"]."'";
	$gamesS = selALL($sql);
	
	if($catS == null){
		if($news != 0){
			$newsBack = selZapG($limt, $news - 1);
		}
		$newsNext = selZapG($limt, $news + 1);
	}else{
		if($news != 0){
			$newsBack = selZapGC($limt, $news - 1, $catS);
		}
		$newsNext = selZapGC($limt, $news + 1, $catS);
	}
	

	if($news != 0){
		if(count($newsBack) != 0){
				$GB = $newsBack[0]['Id'];
				$news--;
				$newsBackH = "/modules/games/bigGame.php?id=$GB&cat=$catS&news=$news";
		}else{
			$newsBackH = "#";
		}
	}
	
	if(count($newsNext) != 0){
		$GN = $newsNext[0]['Id'];
		$news++;
		$newsNextH = "/modules/games/bigGame.php?id=$GN&cat=$catS&news=$news";
	}else{
		$newsNextH = "#";
	}
	
	echo "<title>".$gamesS[0]["NamesGame"]." </title>";
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
		<h1><?php echo $gamesS[0]["NamesGame"]; ?></h1>
	</div>
	<?php
		$sql = "SELECT * From user Where Id = '".$games[0]["IdUser"]."'";
		$userName = selALL($sql);
		echo "<div class='bigArtaicleId'>
		<img src=".$gamesS[0]["FileG"]." alt=".$gamesS[0]["NamesGame"]." title=".$gamesS[0]["NamesGame"].">
		<p>".$gamesS[0]["Discript"]."</p>
		<p>Автор: ".$userName[0]["Name"]."</p>
		</div>";
	?>
	
	<div class="HeadDiv">
		<nav class="dwsMenu">
			<ul>
				<li><a href="<?php echo $newsBackH; ?>"><i class="fa fa-reply"></i>Предыдущя</a></li>
				<li><a href='/modules/games/game.php?cat=<?php echo $catS;?>'><i class="fa fa-newspaper-o"></i>К списку игр</a></li>
				<li><a href="<?php echo $newsNextH; ?>"><i class="fa fa-share"></i>Следующая</a></li>
			</ul>
		</nav>
	</div>
	
	
<?php

require_once root."/modules/html/footer.php";
?>