<?php

namespace Imie\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="Imie\BlogBundle\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="Article",mappedBy="categories")
     */
    private $articleCategories;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Categorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }
      /**
     * Set articleCategories
     *
     * @param string $articleCategories
     * @return Article
     */
    public function setArticleCategories($articleCategories)
    {
        $this->articleCategories = $articleCategories;

        return $this;
    }

    /**
     * Get articleCategories
     *
     * @return string 
     */
    public function getArticleCategories()
    {
        return $this->articleCategories;
    }

    public function __toString()
    {
        return $this->nom;

    }
}
