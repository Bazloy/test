<?php
define(root, $_SERVER["DOCUMENT_ROOT"]);
require_once root."/modules/sessions.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<?php
    require_once root."/modules/html/head_meta.php";
	
	$sql = "SELECT * From news Where Id = '".$_GET["id"]."'";
	$news = selALL($sql);
	$GB = $_GET["id"] - 1;
	$GN = $_GET["id"] + 1;
	$sql = "SELECT * From news Where Id = '".$GB."'";
	$newsBack = selALL($sql);
	$sql = "SELECT * From news Where Id = '".$GN."'";
	$newsNext = selALL($sql);
	
	if(count($newsBack) != 0){
		$newsBackH = "/modules/news/bigArtaicle.php?id=$GB";
	}else{
		$newsBackH = "#";
	}
	
	if(count($newsNext) != 0){
		$newsNextH = "/modules/news/bigArtaicle.php?id=$GN";
	}else{
		$newsNextH = "#";
	}
	
	echo "<title>".$news[0]["Headline"]." </title>";
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
		<h1><?php echo $news[0]["Headline"]; ?></h1>
	</div>
	<?php
		echo "<div class='bigArtaicleId'>
		<img src=".$news[0]["ImageF"]." alt=".$news[0]["Headline"]." title=".$news[0]["Headline"].">
		<p>".$news[0]["Description"]."</p>
		</div>";
	?>
	
	<div class="HeadDiv">
		<nav class="dwsMenu">
			<ul>
				<li><a href="<?php echo $newsBackH; ?>"><i class="fa fa-reply"></i>Предыдущя</a></li>
				<li><a href="/modules/news/news.php"><i class="fa fa-newspaper-o"></i>К новостям</a></li>
				<li><a href="<?php echo $newsNextH; ?>"><i class="fa fa-share"></i>Следующая</a></li>
			</ul>
		</nav>
	</div>
	
	
<?php

require_once root."/modules/html/footer.php";
?>