<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Form\AvisType;

class AvisController extends AbstractController
{
    // Controller permettant l'ajout d'un avis
    #[Route('/ajout-avis/{id}', name: 'avis')]
    public function index(): Response
    {
        
        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
        ]);
    }
}
