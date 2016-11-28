<!DOCTYPE html>

<html lang="fr">
	<head>

		<title><?php echo $this->e($title) ; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" >

		<!--  $this -> assetUrl('css/style.css') vaudra : 'assets/css/style.css'  -->
		<link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/reset.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/style.css'); ?>">
	</head>

	<body>
	<header>
		<h1><?php echo $this->e($title) ; ?></h1>
	</header>

	<aside>
		<h3><a href="<?php echo $this->url('default_home') ; ?>" title="Retour à l'accueil">Les salons</a></h3>
		<nav>
			<ul id="menu-salons">

				
				<li><a href="<?php echo $this->url('default_home') ; ?>">Retour à l'accueil</a></li>
				<li><a href="<?php echo $this->url('users_list') ; ?>" title="Liste des utilisateurs" >Liste des utilisateurs</a></li>
				<li><a href="deconnection.php" id="deconnection" class="button">Déconnection</a></li>	
			</ul>
		</nav>
	</aside><main>

	<section>
		<?= $this->section('main_content') ?>
	</section>

	</main>

	<footer>
	</footer>

</body>

</html>