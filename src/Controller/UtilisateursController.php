<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ModifProfilType;

class UtilisateursController extends AbstractController
{
    // Page de profil
    #[Route('/profil', name: 'profil')]
    public function profil(EntityManagerInterface $entityManagerInterface): Response
    {
        // On récupère tous les utilisateurs
        $utilisateurs = $entityManagerInterface->getRepository(User::class)->findAll();

        return $this->render('utilisateurs/profil.html.twig', [
            'utilisateurs' => $utilisateurs
        ]);
    }

    // Page de modification d'un profil
    #[Route('/modif-profil/{id}', name: 'modif-profil')]
    public function modifProfil(EntityManagerInterface $emi, Request $request): Response
    {
        // Récupération de l'id de l'utilisateur
        $id = $request->get('id');

        // Récupération de l'utilisateur
        $utilisateur = $emi->getRepository(User::class)->find($id);

        // Récupération de l'utilisateur 
        $form = $this->createForm(ModifProfilType::class, $utilisateur);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){   
                $emi->persist($utilisateur);
                $emi->flush();
                
                $this->addFlash('notice','Libellé modifié');
                return $this->redirectToRoute('profil');
            }
        }
        
        return $this->render('utilisateurs/modif-profil.html.twig', [
            'ModifProfilForm' => $form->createView()
        ]);
    }
}
