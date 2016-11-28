<?php

namespace Controller;


use Model\UtilisateursModel;

class UserController extends BaseController
{

	/**
	 * Cette fonction sert à afficher la liste des utilisateurs
	 */
		public function listUsers() {
			
			/*
				Ici j'instancie depuis l'action du contrôleur un modèle d'utilisateurs
				pour pouvoir accéder à la liste des utilisateurs
			*/
				
				$usersModel = new UtilisateursModel();

				$usersList = $usersModel-> findAll();

			// la ligne suivante affiche la vue presente dans app/views/users/list.php
			// et injecte la tableau $usersList sous un nouveau nom $listUsers
			$this->show( 'users/list', array( 'listUsers' => $usersList) );


		}

}