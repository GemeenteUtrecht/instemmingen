<?php
// api/src/Controller/CreateBookPublication.php

namespace App\Controller;

use App\Entity\Token;

class InstemmingController
{
	public function __invoke(Token $data): Tokens
	{
		//$this->bookPublishingHandler->handle($data);
		
		return $data;
	}
}