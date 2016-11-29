<?php $this->layout('layout', ['title' => 'S\'inscrire à T\'Chat']) ?>

<?php
// affichage des valeurs du formulaire dans le formulaire l'or d'un réafichage suite à une erreur de saisie
	function afficherPost($champ) {
		echo ( ( ! empty($_POST[$champ]) )? $_POST[$champ] : '');
	}


// affichage de CHECKED dans les boutons radio si celui-ci à été validé
	function afficherCheck($valeurAttendue) {
		 echo ( (!empty($_POST['sexe'])) && ($_POST['sexe'] == $valeurAttendue)? 'CHECKED' : '' );

	}
?>

<?php $this -> start('main_content'); ?>

	<h2>Inscription d'un utilisateur à T'Chat</h2>

	<?php $fmsg -> display() ; ?>

	<form action="<?php echo $this->url('register'); ?>" method="POST" enctype="multipart/form-data">
		<!-- pseudo, email, password, sexe, avatar -->
		<p>
			<label for="pseudo" >Pseudo.............. :</label>
			<input type="text" name="pseudo" id="pseudo" value="<?php afficherPost('pseudo') ?>" placeholder=" de 3 à 50 caractères" />
			
		</p>
		<p>
			<label for="email">E-mail................ :</label>
			<input type="email" name="email" id="email" value="<?php afficherPost('email') ?>" placeholder="  email@email.fr" />
			
		</p>
		<p>
			<label for="mot_de_passe">Mot de passe.... :</label>
			<input type="password" name="mot_de_passe" id="mot_de_passe"  value="<?php afficherPost('mot_de_passe') ?>"  />
			<button class="button" id="enClaire" type="button" >En Claire</button>
			
		</p>
		<p>
			<label for="femme">femme : </label><input type="radio" value="femme" name="sexe" id="femme" <?php afficherCheck('femme') ?> />
			<label for="homme">homme : </label><input type="radio" value="homme" name="sexe" id="homme" <?php afficherCheck('homme') ?>  />
			<label for="non-defini">non-defini : </label><input type="radio" value="non-defini" name="sexe" id="non-defini" <?php afficherCheck('non-defini') ?>/> 	
		</p>
		<p>
			<label for="avatar">Avatar (JPG - PNG - GIF - < 1Mo) : </label>
			<input type="file" name="avatar" id="avatar" class="button">
			
		</p>
		<p>
			<input type="submit" name="envoi" value="Envoi du formulaire" class="button">
		</p>
	</form>



<?php $this -> stop('main_content'); ?>