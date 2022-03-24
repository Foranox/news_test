<?php
	error_reporting(-1);
	ini_set('display_errors',1);
	header('Content-Type: text/html; charset=utf-8');
	
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else { 
		$page = 1;
	}
	
	$configs = include('config.php');
	
	$rangefrom = $page_size * $page - $page_size;
	$result = $pdo->query("SELECT * FROM news ORDER BY idate DESC LIMIT $rangefrom, $page_size");
   
	$newscount = $pdo->query("SELECT COUNT(*) as count FROM news")->fetch();
	$pagescount = ceil($newscount["count"] / $page_size);
	
?>

<html>
<head>
	<title>Тестовое задание</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="styles/style.css"> 
</head>
<body>
	<div class="content">
		<div class="header">
			<h1 class="h1">Новости</h1>
		</div>
		<?php while($row = $result->fetch()): ?>
			<div class="newsbox">
				<p class="date"><?= gmdate("d.m.Y", $row["idate"]) ?></p>
				<a href="view.php?id=<?= $row["id"] ?>" class="link"><?= $row["title"] ?></a>
				<p class="description"><?= $row["announce"] ?></p>
			</div>
		<?php endwhile; ?>
		<div class="footer">
			<h3 class="">Страницы:</h1>
			<?php for($i = 1; $i <= $pagescount; $i++): if($i != $page):?>
				<a href="news.php?page=<?= $i ?>" class="pagination"><?= $i ?></a>
			<?php else: ?>
				<a class="pagination_active pagination"><?= $i ?></a>
			<?php endif; endfor; ?>
		</div>
	</div>
	

</body>
</html>

