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
		<h1><?php echo $this->e($title) ; ?> <?php  echo ( ( $w_user )? ' ('.$w_user['pseudo'].')' : '' ); ?></h1>
	</header>

	<aside>
		<h3><a href="<?php echo $this->url('default_home') ; ?>" title="Retour à l'accueil">Les salons</a></h3>
		<nav>
			<ul id="menu-salons">

				<?php foreach ($salons as  $nomSalon) : ?>

					<!-- $clef sera l'identifiant du salon ( numéro du salon dans la base de donnée ) -->
					<li><a href="<?php echo $this -> url( 'see_salon', array( 'id' => $nomSalon['id'] ) ) ?>"><?php echo $this -> e( $nomSalon['nom'] ); ?></a></li>

				<?php endforeach ; ?>

				
				<li><a href="<?php echo $this->url('default_home') ; ?>">Retour à l'accueil</a></li>


				<?php if ( in_array( $w_user['role'], ['admin', 'superadmin' ] ) ) : ?>
				<li><a href="<?php echo $this->url('users_list') ; ?>" title="Liste des utilisateurs" >Liste des utilisateurs</a></li>
				<?php endif ; ?>



				<li><a href="<?php echo $this->url('logout'); ?>" id="deconnexion_connexion" class="button" title="Connexion et/ou  Déconnexion"><?php echo( ( $w_user ) ? 'Déconnexion' : 'Connexion' ) ;   ?></a></li>	
			</ul>
		</nav>
	</aside><main>

	<section>
		<p class="erreur" ><?php $fmsg -> display(); ?></p>
		<?= $this->section('main_content') ?>
	</section>

	</main>

	<footer>
	</footer>


	<!-- jquery et javaScript -->
		<script  src="https://code.jquery.com/jquery-2.2.4.min.js"  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="  crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?php echo $this-> assetUrl('js/close-flash-messenges.js') ?>"> </script>
		<?php $sectionJavascripts = $this -> section('javascripts');
		 if ($sectionJavascripts) { 
		 	echo $sectionJavascripts; 
		 } 
		 ?>




</body>

</html>