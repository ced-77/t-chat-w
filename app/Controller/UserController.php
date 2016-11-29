<?php

namespace Controller;

use W\Security\AuthentificationModel;

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

		// fin de la fonction listUsers()
		}


	/**
	 * 
	 */
 		public function login() {

 			/*
 			 on va utiliser le model d'authentification :
 			 la methode isValidLoginInfo à laquelle on passera en param
 			 le pseudo/email et le password envoye en post par l'utilisateurs
 			une fois cette verification faite on, on recupere l'utilisateur en bdd,
 			on le connecte et on le redirige vers la page d'accueil
			*/

 			if ( ! empty($_POST) && ! empty( $_POST['pseudo'] ) && ! empty( $_POST['mot_de_passe'] ) ) {

 				$pseudo = $_POST['pseudo'];
 				$password = $_POST['mot_de_passe'];

 				// verification du login
 				$authentification = new AuthentificationModel();

 				$identifiant = $authentification -> isValidLoginInfo($pseudo, $password);

 					if ( ! empty($identifiant) ) {

 						// recuperation des infos de l'utilisateur
 							$usersModel = new UtilisateursModel();

 							$usersdonnees = $usersModel -> find($identifiant); 

 						// connecte l'indentifiant 
 							$authentification -> logUserIn($usersdonnees);

 							// retour à la page d'accueil
 								$this -> redirectToRoute('default_home');


 					} else { 
 						// idenfiant = 0;
 						// les infos de connection sont incorecte
 						$this -> getFlashMessenger()->error('mot de passe ou indentifiant invalide');
 						

 					}


 			} 
 				// post = null
 				$this -> show( 'users/login', array( 'datas' => ( isset( $_POST ) ) ? $_POST : array() ) );
 			


 		// fin de la fonction login()	
 		}

  		public function logout() {
  			$auth = new AuthentificationModel();
  			$auth -> logUserOut();
  			$this -> redirectToRoute('login');

  		// fin de la foncion
  		}


  		/**
  		 * 
  		 */

  			public function register() {
  				$this->show('User/register');
  			}




// fin de la class
}