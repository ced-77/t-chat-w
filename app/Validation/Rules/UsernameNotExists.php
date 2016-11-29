<?php

/**
 * Cette class sert à étendre les fonctionnalité de la librairy de la 
 * bibliotheque respect/validation
 * En y ajoutant un nouveau validateur
 */
namespace Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use W\Model\UsersModel;

class UsernameNotExists extends AbstractRule
{

	public function validate($pseudo) {
				$userModel = new UsersModel();
				return ! $userModel -> usernameExists($pseudo); 

	}



}