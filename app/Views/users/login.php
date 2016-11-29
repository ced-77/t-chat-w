<?php $this->layout('layout', ['title' => 'Connection à T\'Chat']) ?>

<?php $this -> start('main_content'); ?>

<h2>Connectez-vous à T'Chat</h2>

<?php  $fmsg -> display() ; ?>

<form action="<?php $this->url('login') ; ?>" method="POST">
	
	<p>
		<label for="pseudo">Veuillez renseigner un peudo : </label>
		<input type="text" 
				name="pseudo" 
				id="pseudo" 
				value="<?php echo isset( $datas['pseudo'] ) ? $datas['pseudo'] : '' ; ?>">
		
	</p>
	<p>
		<label for="mot_de_passe">Votre mot de passe............... : </label>
		<input type="password" name="mot_de_passe" id="mot_de_passe">
		<button class="button" id="enClaire" Type="button" >En claire</button>
		
	</p>
	<p>
		<input type="submit" class="button" value="Me connecter">
		<a href="#" class="button" title="accedez à la page d'inscription" >Creer un nouveau compte</a>
	</p>
</form>

<?php $this -> stop('main_content'); ?>