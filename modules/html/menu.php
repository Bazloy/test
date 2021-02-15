
		<div class="HeadDiv">
			<nav class="dwsMenu">
				<ul>
					<li><a href="/index.php"><i class="fa fa-home"></i>Главная</a></li>
					<li><a href="/modules/news/news.php"><i class="fa fa-newspaper-o"></i>Новости</a></li>
					<li><a href="/modules/games/game.php"><i class="fa fa-gamepad"></i>Игры</a>
						<ul>
						<?php
							$sql = "SELECT * From categoryG";
							$cat = selALL($sql);
							for($i = 0; $i < count($cat); $i++){
								
								echo "<li><a href='/modules/games/game.php?cat=".$cat[$i]["Id"]."'>".$cat[$i]["NameCatG"]."</a></li>";
							}
						?>
						</ul>
					</li>
					<li><a href="/modules/files/file.php"><i class="fa fa-floppy-o"></i>Файлы</a>
						<ul>
						<?php
							$sql = "SELECT * From categoryf";
							$catf = selALL($sql);
							for($i = 0; $i < count($catf); $i++){
								
								echo "<li><a href='/modules/files/file.php?cat=".$catf[$i]["Id"]."'>".$catf[$i]["NameCatF"]."</a></li>";
							}
						?>
						</ul>
					</li>
					<li><a href="/modules/pages/about.php"><i class="fa fa-eye"></i>О нас</a></li>
					<li><a href="/modules/user/profile.php" style="display:<?php if(!$_SESSION["user_id"]){echo "none";}else{echo "bloc";}?>" /><i class="fa fa-eye"></i>Личный кабинет</a></li>
					<li><input class="VBtn" type="button" name="VBtn" id="VBtn" value="Войти" style="display:<?php if(!$_SESSION["user_id"]){echo "bloc";}else{echo "none";}?>"/></li>
					<li><input class="VBtn" type="button" name="СBtn" id="СBtn" value="Выйти" style="display:<?php if(!$_SESSION["user_id"]){echo "none";}else{echo "bloc";}?>" /></li>
				</ul>
			</nav>
		</div>
		
		<div id="modalO" class="modalO">
			<div class="modalCon">
				<span class="close" >&times;</span>
				<h1 class="h1Form"> Авторизация </h1>
				<div id="messegeShow"></div>
				<form class="formForm" action="" method="POST">
					<div class="formGroup">
						<label for="">Логин</label>
						<input type="text" class="inputForm" name="LoginA" id="LoginA" placeholder="Введите логин" value="<?php $val1?>">
					</div>
					<div class="formGroup">
						<label for="">Пароль</label>
						<input type="password" class="inputForm" name="PassA" id="PassA" placeholder="Введите пароль">
					</div>
					<div class="formGroup">
						<center><input class="buttonForm" type="button" name="VBtnF" id="VBtnF" value="Войти" /></center>
					</div>
				</form>
			</div>	
		</div>