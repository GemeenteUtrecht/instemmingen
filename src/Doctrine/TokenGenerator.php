<?php
// src/Service/BAGClient.php
namespace App\Doctrine;

use Doctrine\ORM\Id\AbstractIdGenerator; 
use Doctrine\ORM\EntityManager;

class TokenGenerator extends AbstractIdGenerator
{
	public function generate(EntityManager $em, $entity)
	{
		return md5(uniqid(rand(), true));
	}
}