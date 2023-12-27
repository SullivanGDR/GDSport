<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Panier;
use App\Entity\Commandes;
use App\Entity\AjoutCommande;
use App\Entity\Ajouter;
use App\Entity\InfoCommande;
use App\Entity\Payement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\InfoCommandeType;
use App\Form\PayementFormType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email; // cette ligne devient inutile
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class CommandeController extends AbstractController
{
    // Début d'une commande
    #[Route('/private-commander', name: 'commander')]
    public function commande(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        // Récupération du user actuellement connecté
        $user = $this->getUser();

        // Estimation des dates de livraison
        $date2 = new \DateTime();
        $date6 = new \DateTime();
        $date2->modify('+2 days');
        $date6->modify('+6 days');

        // Récupération des informations personnelles du user si il y en a (Nom, Prénom, etc..)
        $infoCommande = $entityManagerInterface->getRepository(InfoCommande::class)->findOneBy(['user' => $user]);

        // Formulaire des informations personnelles
        $infoCommandeForm = $this->createForm(InfoCommandeType::class, $infoCommande);

        if($request->isMethod('POST')){
            $infoCommandeForm->handleRequest($request);
            if ($infoCommande) { // Vérifie si $infoCommande n'est pas null
                $infoCommande = $infoCommandeForm->getData();
                $infoCommande->setUser($this->getUser());
                $entityManagerInterface->persist($infoCommande);
                $entityManagerInterface->flush();

                return $this->redirectToRoute('commande-informations-paiements');
            } else {
                // Si $infoCommande est null, créer une nouvelle instance de l'entité InfoCommande
                $infoCommande = new InfoCommande();
                $infoCommande = $infoCommandeForm->getData();
                $infoCommande->setUser($this->getUser());
                $entityManagerInterface->persist($infoCommande);
                $entityManagerInterface->flush();

                return $this->redirectToRoute('commande-informations-paiements');
            }
        }

        return $this->render('commande/commander.html.twig', [
            'infoCommandeForm'=> $infoCommandeForm->createView(),
            'date2' => $date2,
            'date6' => $date6
        ]);
    }

    // Suite de la commande : informations de paiements
    #[Route('/private/commande-informations-paiements', name: 'commande-informations-paiements')]
    public function commande2(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        // Récupération du user
        $user = $this->getUser();

        // Récupération des informations de la commande (ici pour avoir le type de livraison)
        $infoCommande = $entityManagerInterface->getRepository(InfoCommande::class)->findOneBy(['user' => $user]);

        // Génération du formulaire pour les informations de paiements
        $form = $this->createForm(PayementFormType::class);

        // Génération d'un nouveau paiement
        $payement = new Payement();
        
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){   
                $payement = $form->getData();
                $entityManagerInterface->persist($payement);
                $entityManagerInterface->flush();
                return $this->redirectToRoute('commande-paiement');
            }
        }

        return $this->render('commande/commander2.html.twig', [
            'form'=> $form->createView(),
            'infoCommande' => $infoCommande
        ]);
    }

    // Finalistation de la commande
    #[Route('/private/commande-paiement', name: 'commande-paiement')]
    public function commande3(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        // Récupération du user
        $user = $this->getUser();

        // Récupération du panier du user
        $panier = $user->getPanier();

        // Génértion des dates de livraison
        $date2 = new \DateTime();
        $date6 = new \DateTime();
        $date2->modify('+2 days');
        $date6->modify('+6 days');

        // Récupération des informations personnelles du user
        $infoCommande = $entityManagerInterface->getRepository(InfoCommande::class)->findOneBy(['user' => $user]);

        // Création d'une nouvelle commande pour le user
        $idcommande = new Commandes();

        // Ajout de la commande au user
        $user->addCommande($idcommande);
        
        // Ici on ajoute chaque article du panier dans la commande (ce qui va nous servir a avoir un récapitulatif de commande par la suite)
        foreach($panier->getAjouters() as $ajout){
            $new_ajout = new  AjoutCommande();
            $new_ajout->setQuantite($ajout->getQuantite());
            $new_ajout->setPrixUnit($ajout->getProduit()->getPrix());
            $idcommande->setTotalPrix($idcommande->getTotalPrix() + $ajout->getProduit()->getPrix());
            $new_ajout->setArticle($ajout->getProduit());
            $new_ajout->setTaille($ajout->getTaille());
            $idcommande->setDateCommande(new \Datetime());

            // On récupère le mode de livraison et on l'ajoute au prix total de la commande
            $idcommande->setLivraison($infoCommande->getLivraison());
            if ($infoCommande->getLivraison() == "express") {
                $idcommande->setDateLivraison($date2);
                $idcommande->setTotalPrix($idcommande->getTotalPrix() + 9.95);
            } else {
                $idcommande->setDateLivraison($date6);
            }
            $new_ajout->setCommande($idcommande);
            $panier->removeAjouter($ajout);
            $entityManagerInterface->persist($panier);
            $entityManagerInterface->persist($new_ajout);
        }
        $entityManagerInterface->flush();
        return $this->redirectToRoute('commande-recap', ['id' => $idcommande->getId()]);
        return $this->render('commande/commander3.html.twig', [
        ]);
    }

    // Page du récapitulatif de la commande
    #[Route('/private-recapitulatif/{id}', name: 'commande-recap')]
    public function commande4(EntityManagerInterface $entityManagerInterface, Request $request, MailerInterface $mailer): Response
    {
        // Récupération de l'id du récapitulatif de la commande
        $id = $request->get('id');

        // Récupérations de la commande
        $commande = $entityManagerInterface->getRepository(Commandes::class)->find($id);

        // Récupération de tous les articles de la commande
        $lignesCommande = $entityManagerInterface->getRepository(AjoutCommande::class)->findBy([
            'Commande' => $id,
        ]);
        
        // Récupération du user connecté
        $user = $this->getUser();

        // Informations personnelles de la commande (personne, adresse, livraison, etc..)
        $infoCommande = $entityManagerInterface->getRepository(InfoCommande::class)->findOneBy(['user' => $user]);
        
        /*
        $email = (new TemplatedEmail())
        ->from('reply.gdr@gmail.com')
        ->to($user->getEmail())
        ->subject('Confirmation de votre commande')
        ->htmlTemplate('commande/recap.html.twig')
        ->context([
            'infoCommande' => $infoCommande,
            'commande' => $commande,
            'ligneCommande' => $lignesCommande
        ]);
              
        $mailer->send($email);
        */

        return $this->render('commande/commander3.html.twig', [
            'infoCommande' => $infoCommande,
            'commande' => $commande,
            'ligneCommande' => $lignesCommande
        ]);
    }
}
