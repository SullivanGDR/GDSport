<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Type;
use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ImagesArticle;
use Symfony\Component\HttpFoundation\Request;

class FemmeController extends AbstractController
{
    #[Route('/femme', name: 'femme')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/index.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements', name: 'femme-vetements')]
    public function femmeVetements(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        
        return $this->render('femme/vetements.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/accessoires', name: 'femme-accessoires')]
    public function femmeAccessoires(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/accessoires.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/chaussures', name: 'femme-chaussures')]
    public function femmeChaussures(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/chaussures.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/sweats', name: 'femme-sweats')]
    public function femmeSweats(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/sweats.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/sweat-shirts', name: 'femme-sweat-shirts')]
    public function femmeSweatShirts(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/sweatshirts.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/vestes', name: 'femme-vestes')]
    public function femmeVestes(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/vestes.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/chemises', name: 'femme-chemises')]
    public function femmeChemises(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/chemises.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/t-shirts', name: 'femme-t-shirts')]
    public function femmeTshirts(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/tshirts.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/jeans', name: 'femme-jeans')]
    public function femmeJeans(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/jeans.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/pantalon', name: 'femme-pantalons')]
    public function femmePantalons(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/pantalons.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/shorts', name: 'femme-shorts')]
    public function femmeShorts(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/shorts.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/joggings', name: 'femme-joggings')]
    public function femmeJoggings(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/joggings.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/sous-vêtements', name: 'femme-sous-vêtements')]
    public function femmeSousVetements(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/sousvetements.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/chaussettes', name: 'femme-chaussettes')]
    public function femmeChaussettes(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/chaussettes.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/jupes', name: 'femme-jupes')]
    public function femmeJupes(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/sousvetements.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/robes', name: 'femme-robes')]
    public function femmeRobes(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/vetements/chaussettes.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
    #[Route('/femme/vêtements/nike', name: 'femme-nike')]
    public function femmeNike(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $femmeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Femme']);
        $articlesFemme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $femmeGenre ]);
        return $this->render('femme/nike.html.twig', [
            'articles' => $articlesFemme
        ]);
    }
}