<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentaireController extends AbstractController
{
      /**
     * @Route("/commentaire", name="new_commentaire")
     */
    public function Create(Request $request, EntityManagerInterface $em): Response{

        $commentaire = new Commentaire;

        $formulaire = $this->createForm(CommentaireType::class, $commentaire);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()){

            $em->persist($commentaire);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }else{
            return $this->render('commentaire/formulaire.html.twig',[
                'type' => 'Ajouter',
                'formulaire' => $formulaire->createView()
    
            ]);
        }

    }

       /**
     * @Route("/commentaire/{id}/delete", name="delete_commentaire")
     */
    public function delete(Commentaire $commentaire, EntityManagerInterface $em){
        $em->remove($commentaire);
        $em->flush();

        return $this->redirectToRoute('accueil');
    }
}
