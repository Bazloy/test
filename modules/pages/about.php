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
		<h1>О нас</h1>
	</div>
	
	<div id="aboutInf">
	
		<p>Lorem Ipsum - это текст-"рыба", 
		часто используемый в печати и вэб-дизайне. 
		Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.
		В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов,
		используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил 
		без заметных изменений пять веков, но и перешагнул в электронный дизайн.
		Его популяризации в новое время послужили публикация листов Letraset 
		с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы 
		электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется 
		Lorem Ipsum.</p>
	
	</div>
	
<?php

require_once root."/modules/html/footer.php";
?>