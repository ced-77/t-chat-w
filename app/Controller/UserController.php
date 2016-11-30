<?php

namespace Controller;

use W\Security\AuthentificationModel;

use Model\UtilisateursModel;
use \Respect\Validation\Validator as v;
use \Respect\Validation\Exceptions\NestedValidationException;

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

  				if (! empty($_POST)) {

  					// on presise à respect\validation que nos regles de validation seront accessible depuis ce namespace
  					v::with("Validation\Rules"); 
  					// declaration d'un tableau contenant les clef de validation
  						$validators = array(
  								'pseudo' => v::length(3,50) -> alnum() -> noWhiteSpace() -> usernameNotExists() -> setName('Nom d\'utilisateur'),
  								'email' => v::email() -> setName('E-mail') -> emailNotExists(),
  								'mot_de_passe' => v::length(3,50) -> alnum() -> noWhiteSpace() -> setName('Mot de passe'),
  								'avatar' => v::optional( v::image() -> size('1MB') -> uploaded() ),
  								'sexe' => v::in(array('femme', 'homme', 'non-defini'))
  							);


  						$datas = $_POST;
  						// on rajoute le chemin du fichier temporaire d'avatar si celui-ci existe

  							if (!empty($_FILES['avatar']['tmp_name'])) {
  								// je stock en donnée à valider le chemin vers le localisation
  								// temporaire de l'avatar
  								$datas['avatar'] = $_FILES['avatar']['tmp_name'];
  							} else { $datas['avatar'] = ''; } // sinon je laisse le champ vide


  						// je parcours la liste de me validateurs
  						//  en recuperant aussi le nom du champ en clé.

  						foreach ($validators as $field => $validator) {

  							// la methode assert renvoie une exeption de type nestedValidationException
  							// qui nous permet de récupérer le ou les messages d'erreur
  							// en cas d'erreur

  							try {$validator -> assert( isset( $datas[$field] ) ? $datas[$field] : '' );} // on essaye de valider la donnée, si une exception se produit c'est le bloque catch qui sera executé
  							catch (NestedValidationException $ex) {
  									$fullMessage = $ex -> getFullMessage();
  									$this -> getFlashMessenger() -> error($fullMessage); 
  							}

  							

  						// fin du foreach	
  						}


  					// si pas d'erreur on insert un nouvel utilisateur
  						if ( ! $this -> getFlashMessenger() -> hasErrors() ) {
  							// avant l'insertion on doit faire deux choses :
  							// Deplacer l'avatar du fichier temporaire vers son dossier
  							// on doit hasher les mot de passe
  							$auth = new AuthentificationModel();

  							$datas['mot_de_passe'] = $auth -> hashPassword($datas['mot_de_passe']);


  							// on depalce l'avatar vers le dossier avatars
  							if  ( !empty($_FILES['avatar']['tmp_name']) ) {
								$initialAvatarPath = $_FILES['avatar']['tmp_name'];
	  							$avatarNewName = md5(time().uniqid());
	  							$targetPath = realpath('assets/uploads/');

	  							move_uploaded_file($initialAvatarPath, $targetPath.'/'.$avatarNewName);

	  							// je vais mettre à jour nouveau nom de l'avatar dans $datas
	  							$datas['avatar'] = $avatarNewName;

  							} else { $datas['avatar'] = 'default.png' ; }

  							

  							// insetion en base de donnée
  							$UtilisateursModel = new UtilisateursModel();

  							unset($datas['send']);

  							$userInfo = $UtilisateursModel -> insert($datas);

  							$auth -> logUserIn($userInfo);

  							$this -> getFlashMessenger() -> success('vous vous êtes bien inscrit à T\'Chat ! ');
  							$this -> redirectToRoute('default_home');

  						}


  				// fin de la fonction register()		
  				}






  				$this->show('users/register');
  			}




// fin de la class
}