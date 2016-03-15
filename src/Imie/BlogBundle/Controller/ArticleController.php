<?php

namespace Imie\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Imie\BlogBundle\Entity\Article;


class ArticleController extends Controller
{
    public function ajoutArticleAction(Request $request)
    {
    	$article = new Article();
        $form = $this->createForm('Imie\BlogBundle\Form\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('imie_article_voir', array('id' => $article->getId()));
        }

        return $this->render('ImieBlogBundle:Blog:ajout.html.twig', array(
            'article' => $article,
            'form' => $form->createView()
        ));
    }

    public function modifArticleAction(Request $request, Article $article)
    {
        //$deleteForm = $this->createDeleteForm($article);
        $editForm = $this->createForm('Imie\BlogBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('imie_article_voir', array('id' => $article->getId()));
        }

        return $this->render('ImieBlogBundle:Blog:modif.html.twig', array(
            'article' => $article,
            'edit_form' => $editForm->createView()
            //'delete_form' => $deleteForm->createView(),
        ));
    }

    public function suppArticleAction($id, Request $request, Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('ImieBlogBundle:Article')->find($id);
        $commentaires = $em->getRepository('ImieBlogBundle:Commentaire')->findCommentaire($id);

        foreach ($commentaires  as $commentaire) {
        	$em->remove($commentaire);
        	$em->flush();
        }
        
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('imie_article_afficher');
    }
    

    public function voirArticleAction($id)
    {
        //$deleteForm = $this->createDeleteForm($article);
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('ImieBlogBundle:Article')->find($id);
       	$commentaires = $em->getRepository('ImieBlogBundle:Commentaire')->findCommentaire($id);
       
        return $this->render('ImieBlogBundle:Blog:voir.html.twig', array(
            'article' => $article,
            'commentaires' => $commentaires,
            //'delete_form' => $deleteForm->createView(),
        ));
   
    }

    public function afficherArticleAction($page)
    {
        $articles = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('ImieBlogBundle:Article')
                     ->getArticles(2, $page); // 3 articles par page : c'est totalement arbitraire !
 
    // On ajoute ici les variables page et nb_page à la vue
	    return $this->render('ImieBlogBundle:Blog:index.html.twig', array(
	      'articles'   => $articles,
	      'page'       => $page,
	      'nombrePage' => ceil(count($articles)/2)
	      ));
    }
}

