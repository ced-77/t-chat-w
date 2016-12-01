<?php

namespace Controller;


use Model\SalonsModel;
use Model\MessagesModel;

class SalonController extends BaseController
{

	/**
	 * Cette action permet de voir la liste des messages
	 * d'un salon
	 * @param int $id l'id du salon dont je veux voir les msg
	 */

		public function seeSalon($id) {


				/*
					Traitement du formulaire d'ajout d'un message de chat
				*/
					// on verifi si la variable $_POST existe et s'il y a qq chose dedans
						if ( isset($_POST) && ! empty($_POST['message']) ) {

							// on recupere les infos de l'utilisateur en session
										$info_utilisateur = $this -> getUser();
										$id_utilisateur = $info_utilisateur['id'];
							
							if ( $info_utilisateur ) {

									// on recupere le message
										$new_message = $_POST['message'];
									

									// on recupere la date de creation
										$date_creation = date('Y-m-d H:i:s');
										$date_modification = $date_creation;
									// on recupere l'image 
										$image_message = NULL;

									// creation d'un tableau qui contient les informations
										$message_info = array(
													'corps' => $new_message,
													'image' => $image_message,
													'date_creation' => $date_creation,
													'date_modification' => $date_modification,
													'id_utilisateur' => $id_utilisateur,
													'id_salon' => $id
											);

									// on instanci un model
										$new_message_model = new MessagesModel();
										$new_message_model -> insert($message_info);


								} else {

									// message d'erreur
										$this -> getFlashMessenger()-> error('vous devez être connecté pour poster un message');
									// si pas de session => redirection vers le login
										$this -> redirectToRoute('login');
										exit;
								}



						} 

				/*
					On instancie le modèle des salons de façon à récupérer
					les informations du salons dont l'id est $id (passé dans l'url)
				*/

				$salonsModel = new SalonsModel();
				$salon = $salonsModel -> find($id);

				/*
					On instancie le modèle des messages pour récupérer les messages du salon dont l'id est $id
				*/

				$messagesModel = new MessagesModel();

				/*
					J'utilise une méthode propre au modèle MessagesModel qui permet de récupérer les messages
					avec les infos utilisateur associées
				*/

				$messages = $messagesModel -> searchAllWithUserinfo($id);
				

				$this->show( 'salons/see', array( 'salon' => $salon, 'messages' => $messages ) );
		
		// fin de la fonction
		}


		public function newMessages($idSalon, $idMessage) {
			$messagesModel = new MessagesModel();
			$messages = $messagesModel -> searchAllWithUserInfos($idSalon, $idMessage);

			$this -> show('salons/newmessages', array('messages' => $messages));
		}

}