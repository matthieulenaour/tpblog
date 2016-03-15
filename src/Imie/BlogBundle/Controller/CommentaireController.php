<?php

namespace Imie\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Imie\BlogBundle\Entity\Article;
use Imie\BlogBundle\Entity\Commentaire;


class CommentaireController extends Controller
{
	public function ajoutCommentaireAction($id, Request $request, Article $article)
    {
    	$commentaire = new Commentaire();

    	$em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('ImieBlogBundle:Article')->find($id);
        $commentaire->setArticle($article);

        $form = $this->createForm('Imie\BlogBundle\Form\CommentaireType', $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();

            return $this->redirectToRoute('imie_article_voir', array('id' => $id));
        }

        return $this->render('ImieBlogBundle:Blog:ajoutCommentaire.html.twig', array(
            'commentaire' => $commentaire,
            'form' => $form->createView(),
            'id' => $id
        ));
    }
    
    public function suppCommentaireAction($id)
    {
        
    }
}