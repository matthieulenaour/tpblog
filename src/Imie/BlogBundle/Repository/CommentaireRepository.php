<?php

namespace Imie\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CommentaireRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentaireRepository extends EntityRepository
{
	public function findCommentaire($id)
	{
		return $this->createQueryBuilder('c')
		 	->where('c.article = :id')
		 	->setParameter(':id', $id)
            ->orderBy('c.date','desc')
            ->getQuery()
            ->getResult();
	}
}
