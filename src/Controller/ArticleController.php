<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{

      /**
     * @Route("/article", name="new_article")
     */
    public function Create(Request $request, EntityManagerInterface $em): Response{

        $article = new Article;

        $formulaire = $this->createForm(ArticleType::class,$article);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()){

            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }else{
            return $this->render('article/formulaire.html.twig',[
                'type' => 'Ajouter',
                'formulaire' => $formulaire->createView()
    
            ]);
        }

    }

      /**
     * @Route("/article/all", name="article_all")
     */
    public function retrieveAll(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        return $this->render('article/article.html.twig', [
            'articles' => $articles
        ]);
    }

       /**
     *  @Route("/article/{id}/update", name="update_article")
     */
    public function Update(Request $request,Article $article, EntityManagerInterface $em): Response{


        $formulaire = $this->createForm(ArticleType::class, $article);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()){

            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }else{
            return $this->render('article/formulaire.html.twig',[
                'type' => 'Ajouter',
                'formulaire' => $formulaire->createView()
    
            ]);
        }

    }



  

     /**
     * @Route("/article/{id}/delete", name="delete_article")
     */
    public function delete(Article $article, EntityManagerInterface $em){
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('accueil');
    }

}
