<?php

namespace Imie\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ImageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ImageRepository extends EntityRepository
{
		public function findImage($id)
	{
		return $this->createQueryBuilder('i')
		 	->where('i.articleImg = :id')
		 	->setParameter(':id', $id)
            ->getQuery()
            ->getResult();
	}
}