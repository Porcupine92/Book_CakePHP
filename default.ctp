<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Moja strona MVC</title>
		
		<link rel="stylesheet" href="/css/main.css">
		
	</head>
	<body>
		<header>
			<div class="logo">Zadanie</div>
		</header>
		<main>
			<?php echo $this->Flash->render(); ?> <!--Ta linua i ta od spodem muszą być -->
			<?php echo $this->fetch('content'); ?>
			
		</main>
		<footer>
			COPYRIGHT SJ 2019
		</footer>
	</body>
</html>
