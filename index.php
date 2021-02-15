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
		
		<div id="about">
			<a href="#" title="Возможности" onclick="slowScroll('#main')">Возможности</a>
			<a href="#" title="Новости" onclick="slowScroll('#overiew')">Новости</a>
			<a href="#" title="Регистрация" onclick="slowScroll('#Registration')">Регистрация</a>
			<a href="#" title="FAQ" onclick="slowScroll('#footer')">О нас</a>
		</div>
	</header>
	
	<div id="top">
		<h1>Сайт разработчиков игр</h1>
		<h3>Здесь вы найдете много полезной информации и материалов</h3>
	</div>
	
	<div id="main">
		<div class="intro">
			<h2>Текст</h2>
			<span>Какой - то текст</span>
		</div>
		<div class="text">
			<span>Еще текст</span>
		</div>
	</div>
	
<?php
require_once root."/modules/html/newsI.php";
require_once root."/modules/html/registration.php";
require_once root."/modules/html/footer.php";



?>
