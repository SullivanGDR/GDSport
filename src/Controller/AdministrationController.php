<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Commandes;
use App\Entity\Article;
use App\Entity\User;
use App\Entity\Support;

class AdministrationController extends AbstractController
{
    // Page administration
    #[Route('/admin', name: 'administration')]
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {
        // Récupération des articles
        $articles = $entityManagerInterface->getRepository(Article::class)->findAll();
        // Récupération des users
        $users = $entityManagerInterface->getRepository(User::class)->findAll();
        // Récupération des commandes
        $commandes = $entityManagerInterface->getRepository(Commandes::class)->findAll();
        // Récupération des demandes de support
        $supports = $entityManagerInterface->getRepository(Support::class)->findAll();
        return $this->render('administration/index.html.twig', [
            'users' => $users,
            'articles' => $articles,
            'commandes' => $commandes,
            'supports' => $supports

        ]);
    }

    // Page de la liste des clients dans le panel administration
    #[Route('/admin-liste-client', name: 'liste-clients')]
    public function listeClients(EntityManagerInterface $entityManagerInterface): Response
    {
        // Récupération des users
        $users = $entityManagerInterface->getRepository(User::class)->findAll();

        return $this->render('administration/liste-clients.html.twig', [
            'users' => $users
        ]);
    }

    // Page de suppression d'un client
    #[Route('/admin-supprimer-client', name: 'supprimer-client1')]
    public function supprimerClient1(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        // Récupération des users
        $users = $entityManagerInterface->getRepository(User::class)->findAll();

        return $this->render('administration/supprimer-client.html.twig', [
            'users' => $users
        ]);
    }

    // Controller permettant de supprimer un client
    #[Route('/admin-supprimer-client/{id}', name: 'supprimer-client')]
    public function supprimerClient(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        // Récupération de l'id du client
        $id = $request->get('id');

        // Récupération du client
        $user = $entityManagerInterface->getRepository(User::class)->find($id);

        // Suppression du client
        $entityManagerInterface->remove($user);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('supprimer-client1');
    }
}
