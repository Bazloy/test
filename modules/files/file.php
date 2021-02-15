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
		$Zag = "Материалы";
		$page = isset($_GET['pageG']) ?  $_GET['pageG']:1;
		$limt = 3;
		$offset = $limt * ($page - 1);
		$filesSel = selZapF($limt, $offset);
		$sqlC = "SELECT * From materials";
		$pageCount = selCount($sqlC);		
	}else{
		$sql = "SELECT * From categoryf Where Id = '".$catS."'";
		$catGT = selALL($sql); 
		$Zag = $catGT[0]["NameCatG"];
		$page = isset($_GET['pageG']) ?  $_GET['pageG']:1;
		$limt = 3;
		$offset = $limt * ($page - 1);
		$filesSel = selZapFC($limt, $offset, $catS);
		$sqlC = "SELECT * From materials";
		$pageCount = selCount($sqlC);
		
		if(count($filesSel) == 0){
			$Zag = "В данной категории нет еще не одного материала"; 
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
		for($i = 0; $i < count($filesSel); $i++){
			$sql = "SELECT * From user Where Id = '".$filesSel[$i]["IdUserM"]."'";
			$userName = selALL($sql);
			echo "<div class='bigArtaicle'>
			<h2>".$filesSel[$i]["NamesFile"]."</h2>
			<img src=".$filesSel[$i]["FileM"]." alt=".$filesSel[$i]["NamesFile"]." title=".$filesSel[$i]["NamesFile"].">
			<p>".$filesSel[$i]["ShortDiscF"]."</p>
			<p>Автор: ".$userName[0]["Name"]."</p>
			<a href='/modules/files/bigFile.php?id=".$filesSel[$i]["Id"]."&cat=".$catS."&news=".$i."'>
				<div>Далее</div>
			</a>
			</div>";
		}
	?>
	
	<div class="HeadDiv">
		<nav class="dwsMenu">
			<ul>
				<?php if($page > 1){$PageL = $page - 1; echo "<li><a href='/modules/files/file.php?pageG=".$PageL."&cat=".$catS."'><i class='fa fa-reply'></i>Предыдущя</a></li>";}?>
				<li><a href='/modules/files/file.php'><i class="fa fa-newspaper-o"></i>Все материалы</a></li>
				<?php if($pageCount - $offset > 0){$PageN = $page + 1; echo "<li><a href='/modules/files/file.php?pageG=".$PageN."&cat=".$catS."'><i class='fa fa-share'></i>Следующая</a></li>";}?>
			</ul>
		</nav>
	</div>
	
<?php

require_once root."/modules/html/footer.php";
?>