<?php

namespace Model;

use \W\Model\Model;
use \PDO;
use \PDOException;


class MessagesModel extends Model
{


	/**
	 * Cette fonction selectionne tous les messages d'un salon
	 * en les  associant avec les infos de leur utilisateur respectif
	 * @param int $idSalon , l'id du salon dont on souhaite récupérer les messages
	 * @return array la liste des messages avec les infos utilisateur
	 */

	public function searchAllWithUserinfo($idSalon, $idMessage = NULL ) {
		$query = "SELECT  * FROM $this->table "
				."JOIN utilisateurs ON $this->table.id_utilisateur = utilisateurs.id "
				." WHERE id_salon = :id_salon";

		$idMessageExists = $idMessage !== NULL && ctype_digit($idMessage);

		if ( $idMessageExists ) { $query .= ' AND messages.id > :id_message '; }

		$query .= ' ORDER BY messages.id ASC';

		$stmt = $this -> dbh ->prepare($query);
		$stmt ->  bindParam(':id_salon', $idSalon,PDO::PARAM_INT);
		if ( $idMessageExists ) { $stmt ->  bindParam(':id_message', $idMessage,PDO::PARAM_INT); }
		$stmt -> execute();

		return $stmt -> fetchAll(PDO::FETCH_ASSOC);
	}


	// /**
	//  * 
	//  */

	// public function insertNewMessage($infoNewMessage) {
	// 	// recuperation des infos
	// 	$corps = $infoNewMessage['corps'];
	// 	$image = $infoNewMessage['image'];
	// 	$date_creation = $infoNewMessage['date_creation'];
	// 	$date_modification = $infoNewMessage['date_modification'];
	// 	$id_utilisateur = $infoNewMessage['id_utilisateur'];
	// 	$id_salon = $infoNewMessage['id_salon'];

	// 	// creation de la requette

	// 	$requete = "  INSERT INTO message  (
	// 							corps,
	// 							image,
	// 							date_creation,
	// 							date_modification,
	// 							id_utilisateur,
	// 							id_salon
	// 							) VALUES (
	// 							$corps,
	// 							$image,
	// 							$date_creation,
	// 							$date_modification,
	// 							$id_utilisateur,
	// 							$id_salon
	// 							)    ";

								

	// }




}