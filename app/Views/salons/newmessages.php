<!--
	exeptionnellement, on n'inscript pas la vue dans un layout car 
	elle va s'executer dans un contexte ajax, je n'ai donc besoin 
	que de la partie qui m'interesse, à savoir la liste des nouveaux
	messages
 -->

<?php
$this -> insert('salons/inc.messages',['$messages'=> $messages]);
?>