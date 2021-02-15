<?php
$news = selZap(4, 0);
?>
	<div id="overiew">
		<h2>Новости</h2>
		<h4>Самые последние новости</h4>
		<?php
			for($i = 0; $i < count($news); $i++){
				echo " <div class='img'>
					<img src=".$news[$i]["ImageF"]." alt=".$news[$i]["Headline"]." title=".$news[$i]["Headline"].">
					<a href='/modules/news/bigArtaicle.php?id=".$news[$i]["Id"]."'><span>".$news[$i]["Headline"]."</span></a>
				</div>";
			}
		?>
		
	</div>