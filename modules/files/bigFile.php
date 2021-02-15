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
	$sql = "SELECT * From materials Where Id = '".$_GET["id"]."'";
	$FaileSel = selALL($sql);

	if($catS == null){
		if($news != 0){
			$newsBack = selZapF($limt, $news - 1);
		}
		$newsNext = selZapF($limt, $news + 1);
	}else{
		if($news != 0){
			$newsBack = selZapFC($limt, $news - 1, $catS);
		}
		$newsNext = selZapFC($limt, $news + 1, $catS);
	}
	
	if($news != 0){
		if(count($newsBack) != 0){
				$GB = $newsBack[0]['Id'];
				$news--;
				$newsBackH = "/modules/files/bigFile.php?id=$GB&cat=$catS&news=$news";
		}else{
			$newsBackH = "#";
		}
	}
	
	if(count($newsNext) != 0){
		$GN = $newsNext[0]['Id'];
		$news++;
		$newsNextH = "/modules/files/bigFile.php?id=$GN&cat=$catS&news=$news";
	}else{
		$newsNextH = "#";
	}
	
	echo "<title>".$FaileSel[0]["NamesFile"]." </title>";
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
		<h1><?php echo $FaileSel[0]["NamesFile"]; ?></h1>
	</div>
	<?php
		$sql = "SELECT * From user Where Id = '".$FaileSel[0]["IdUserM"]."'";
		$userName = selALL($sql);
		echo "<div class='bigArtaicleId'>
		<img src=".$FaileSel[0]["FileM"]." alt=".$FaileSel[0]["NamesFile"]." title=".$FaileSel[0]["NamesFile"].">
		<p>".$FaileSel[0]["DiscriptF"]."</p>
		<p>Автор: ".$userName[0]["Name"]."</p>
		</div>";
	?>
	
	<div class="HeadDiv">
		<nav class="dwsMenu">
			<ul>
				<li><a href="<?php echo $newsBackH; ?>"><i class="fa fa-reply"></i>Предыдущя</a></li>
				<li><a href='/modules/files/file.php?cat=<?php echo $catS;?>'><i class="fa fa-newspaper-o"></i>К списку материалов</a></li>
				<li><a href="<?php echo $newsNextH; ?>"><i class="fa fa-share"></i>Следующая</a></li>
			</ul>
		</nav>
	</div>
	
	
<?php

require_once root."/modules/html/footer.php";
?>