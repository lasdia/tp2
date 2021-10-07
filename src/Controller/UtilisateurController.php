<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur_new")
     */
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $utilisateur = new Utilisateur();
        $formulaire = $this->createForm(UtilisateurType::class, $utilisateur);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('accueil');
        }
        return $this->renderForm('utilisateur/utilisateur_new.html.twig', [
            'utilisateur' => $utilisateur,
            'formulaire' => $formulaire,
        ]);
    }

     /**
     * @Route("/{id}/edit", name="utilisateur_edit")
     */
    public function modifier(Request $request, Utilisateur $utilisateur): Response
    {
        $formulaire = $this->createForm(UtilisateurType::class, $utilisateur);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('accueil');
        }
        return $this->renderForm('utilisateur/utilisateur_edit.html.twig', [
            'utilisateur' => $utilisateur,
            'formulaire' => $formulaire,
        ]);
    }


    /**
     * @Route("/utilisateur/all", name="utilisateur_all")
    */
    public function retrieveAll(UtilisateurRepository $utilisateurRepository) : Response
    {  
        $utilisateur = $utilisateurRepository->findAll();
        return $this->render('utilisateur/utilisateurAll.html.twig',[
           'utilisateurs'=> $utilisateur
        ]);
        
    }



    /**
     * @Route("/{id}/delete", name="utilisateur_delete")
     */
    public function delete(Request $request, Utilisateur $utilisateur) : Response{
   
        if ($this->isCsrfTokenValid('delete' . $utilisateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($utilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('utilisateur_all');
        
    }



}
