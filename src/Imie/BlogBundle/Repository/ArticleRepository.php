<?php

namespace Imie\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
	public function findArticle($id)
	{
		return $this->createQueryBuilder('a')
	                ->leftJoin('a.image', 'i')
	                ->addSelect('i')
	               	->leftJoin('a.categories', 'cat')
	                ->addSelect('cat')
	                ->where('a.id = :id')
		 			->setParameter(':id', $id)
	                ->getQuery()
	                ->getResult();
	}


	public function getArticles($nombreParPage, $page)
	{
	   $query = $this->createQueryBuilder('a')
	                  ->leftJoin('a.image', 'i')
	                    ->addSelect('i')
	                  ->leftJoin('a.categories', 'cat')
	                    ->addSelect('cat')
	                  ->orderBy('a.date', 'DESC')
	                  ->getQuery();
	    // On définit l'article à partir duquel commencer la liste
	    $query->setFirstResult(($page-1) * $nombreParPage)
	    // Ainsi que le nombre d'articles à afficher
	          ->setMaxResults($nombreParPage);
	    // Enfin, on retourne l'objet Paginator correspondant à la requête construite
	    // (n'oubliez pas le use correspondant en début de fichier)
	    return new Paginator($query);
	}
}
