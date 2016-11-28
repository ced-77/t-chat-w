<?php $this -> layout('layout', ['title' => "Messages de mon salon"]); ?>

<?php $this -> start('main_content'); ?>

	<h2>Bienvenue sur le salon <?php echo $this->e($salon['nom']) ?></h2>
	


	<ol class="messages">
	<!-- affichage du message de confirmation de creation du salon  -->
		 <!-- <?php echo $messageCreationSalon ?> -->

		<!-- 
			On récupére les dialogue ainsi que les noms des intervenants 
		-->

		<?php foreach ( $messages as $dialogue) :?>
		<li><span class="personne"><?php echo $this->e($dialogue['pseudo']) ?></span> : <span class="message"><?php echo $this->e($dialogue['corps']) ?></span></li>

		<?php endforeach ?>
	</ol>

	<!-- 
		ouverture d'un formulaire pour envoyer un message dans le salon 
	-->

	<!-- 
		J'envoie mon formulaire d'ajout de message sur la page courante, cela va me permettre
		d'ajouter mes messages à ce salon précisement.
		$this -> url('see_salon', array('id' => $salon['id'] )) va generer une url du type : 
		t-chat-w/public/salon/$salon['id']
	 -->
	<form class="form-message" action="<?php $this->url( 'see_salon', array( 'id' => $salon['id'] ) ); ?>" method="POST">
		<label for="message" name="message" ></label>
		<input type="text" name="message" id="message"></input> 
		<input type="submit" value="Validez" class="button">
		
	</form>	

<?php $this -> stop('main_content'); ?>
