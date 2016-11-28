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

}