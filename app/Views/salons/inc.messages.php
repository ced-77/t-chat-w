<?php 


foreach ( $messages as $dialogue) :?>



	<!-- 
		pour les requetes du chat, j'ai besion de l'id du dernier message
		Ici, je fais en sorte que cette information soit portée par tous les messages
	 -->
	<li data-id = "<?php echo $messages['id'] ; ?>">
		<span class="avatar"><img src="<?php echo( $this-> assetUrl( 'uploads/'.$dialogue['avatar'] ) ); ?>" /></span>
		<span class="personne"><?php echo $this->e($dialogue['pseudo']) ?></span> : <span class="message"><?php echo $this->e($dialogue['corps']) ?></span>
	</li>

<?php endforeach ?>