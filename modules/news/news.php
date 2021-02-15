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
	$page = isset($_GET['page']) ?  $_GET['page']:1;
	$limt = 3;
	$offset = $limt * ($page - 1);
	$news = selZap($limt, $offset);
	$sqlC = "SELECT * From news";
	$pageCount = selCount($sqlC);
	
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
		<h1>Новости инди индустрии</h1>
	</div>
	<?php
		for($i = 0; $i < count($news); $i++){
			echo "<div class='bigArtaicle'>
			<h2>".$news[$i]["Headline"]."</h2>
			<img src=".$news[$i]["ImageF"]." alt=".$news[$i]["Headline"]." title=".$news[$i]["Headline"].">
			<p>".$news[$i]["ShortDescription"]."</p>
			<a href='/modules/news/bigArtaicle.php?id=".$news[$i]["Id"]."'>
				<div>Далее</div>
			</a>
			</div>";
		}
	?>
	
	<div class="HeadDiv">
		<nav class="dwsMenu">
			<ul>
				<?php if($page > 1){$PageL = $page - 1; echo "<li><a href='/modules/news/news.php?page=$PageL'><i class='fa fa-reply'></i>Предыдущя</a></li>";}?>
				<?php if($pageCount - $offset > 0){$PageN = $page + 1; echo "<li><a href='/modules/news/news.php?page=$PageN'><i class='fa fa-share'></i>Следующая</a></li>";}?>
			</ul>
		</nav>
	</div>
	
<?php

require_once root."/modules/html/footer.php";
?>