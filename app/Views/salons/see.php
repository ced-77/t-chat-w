<?php $this -> layout('layout', ['title' => "Messages de mon salon"]); ?>

<!--  affichage de la page  -->

<?php $this -> start('main_content'); ?>

	<h2>Bienvenue sur le salon <?php echo $this->e($salon['nom']) ?></h2>
	


	<ol class="messages">
	<!-- affichage du message de confirmation de creation du salon  -->
		 <!-- <?php echo $messageCreationSalon ?> -->

		<!-- 
			On récupére les dialogue ainsi que les noms des intervenants 
		-->

		<?php $this -> insert('salons/inc.messages',['messages'=> $messages]) ; ?>
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

	 <?php if ( $w_user) : ?>
	<form class="form-message" action="<?php $this->url( 'see_salon', array( 'id' => $salon['id'] ) ); ?>" method="POST">
		<label for="message" name="message" ></label>
		<input type="text" name="message" id="message"></input> 
		<input type="submit" value="Validez" class="button">
		
	</form>

	<?php  else : ?>
		<a href="<?php $this->url('login'); ?>" title="Accès au formulaire de connexion" > Connectez-vous pour poster un message ! </a>	

	<?php endif; ?>

<?php $this -> stop('main_content'); ?>

<!-- affichage du script -->

<?php $this -> start('javascripts'); ?>

<script type="text/javascript" src="<?php echo $this -> assetUrl('prepare-chat.js') ?>"></script>
<script type="text/javascript">

	var salonId = <?php echo( $salon['id'] ); ?>;
	var homeUrl = <?php echo $this -> url('default_home') ; ?>;
	$(document).ready(function(){
			setInterval(function(){
					var lastMessageId = $('.messages >li:last-child').data('id');
					$.get(homeUrl+'/newmessages/'+salonId+'/'+lastMessageId, [], function(data) {
								$('messages').append(data).scrollTop($('.messages').height());
					});

			}, 500);
	});
</script>

<?php $this -> start('javascripts'); ?>
