<?php

namespace Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationExeption;


class UsernameNotExistsException extends Exceptions
{

		public static $defaultTemplates = array(
				self::MODE_DEFAULT => [
						'Le nom d\'utilisateur existe déjà'
				],
				self::MODE_NEGATIVE => [
						'Le nom d\'utilisateur existe déjà'
				]
			);



	
}