<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SupportType;
use App\Entity\Support;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AideController extends AbstractController
{
    // Page aide
    #[Route('/aide', name: 'aide')]
    public function index(Request $request,EntityManagerInterface $entityManagerInterface): Response
    {
        // Génération d'un nouveau support avec récupération du formulaire
        $support = new Support();

        $form = $this->createForm(SupportType::class, $support);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){   
                $entityManagerInterface->persist($support);
                $entityManagerInterface->flush();

                return $this->redirectToRoute('aide');
            }
        }
        return $this->render('aide/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Page aide, retours et échanges en ligne
    #[Route('/aide-retours-et-echanges-online', name: 'aide-retours-et-echanges-online')]
    public function RetEenLigne(): Response
    {
        return $this->render('aide/aide-retours-et-echanges-online.html.twig', [
        ]);
    }

    // Page aide, retours et échanges en magasin
    #[Route('/aide-retours-et-echanges-magasin', name: 'aide-retours-et-echanges-magasin')]
    public function RetEenMagasin(): Response
    {
        return $this->render('aide/aide-retours-et-echanges-magasin.html.twig', [
        ]);
    }

    // Page aide concernant la qualité
    #[Route('/aide-qualite', name: 'aide-qualite')]
    public function aideQualite(): Response
    {
        return $this->render('aide/aide-qualite.html.twig', [
        ]);
    }

    // Page aide concernant les suivis de colis
    #[Route('/aide-suivis', name: 'aide-suivis')]
    public function aideSuivis(): Response
    {
        return $this->render('aide/aide-suivis.html.twig', [
        ]);
    }
}
