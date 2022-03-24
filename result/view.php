<?php
	error_reporting(-1);
	ini_set('display_errors',1);
	header('Content-Type: text/html; charset=utf-8');
	if (isset($_GET['id'])) 
	{ 
		$configs = include('config.php');
		$id = $_GET['id'];
		
		$article_content = $pdo->query("SELECT * FROM news  WHERE id = $id")->fetch();
	 }
	
?>


<html>
<head>
	<title>Тестовое задание - <?= $article_content["title"] ?></title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="styles/style.css"> 
</head>
<body>

	
	<div class="content">
		<?php if(isset($_GET['id'])):?>
			<div class="header">
				<h1 class="h1"><?= $article_content["title"] ?></h1>
			</div>
			<div class="newsbox">
				<div class="description" style="margin: -20px 0 0 0;">
					<?= $article_content["content"] ?>
				</div>
			</div>
		<?php else: ?>
			<div class="header">
				<h1 class="h1">Данной статьи не существует.</h1>
			</div>
		<?php endif; ?>
		<div class="footer">
			<!-- В Задании было только возвращение на первую страницу - это реализовано на 44 строке.  -->
			<?php if(isset($_SERVER['HTTP_REFERER'])):?>
				<a href="#" OnClick="history.back();" class="link">Все новости >></a>
			<?php else: ?>
				<a href="news.php" class="link">Все новости >></a>
			<?php endif; ?>
		</div>
	</div>
</body>
</html>