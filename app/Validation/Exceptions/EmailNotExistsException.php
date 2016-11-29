<?php

namespace Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationExeption;


class EmailNotExistsException extends Exceptions
{

		public static $defaultTemplates = array(
				self::MODE_DEFAULT => [
						'L\'email existe déjà'
				],
				self::MODE_NEGATIVE => [
						'L\'email existe déjà'
				]
			);



	
}