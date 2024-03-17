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

class JuniorController extends AbstractController
{
    #[Route('/junior', name: 'junior')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/index.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements', name: 'junior-vetements')]
    public function juniorVetements(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/accessoires', name: 'junior-accessoires')]
    public function juniorAccessoires(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/accessoires.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/chaussures', name: 'junior-chaussures')]
    public function juniorChaussures(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/chaussures.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/sweats', name: 'junior-sweats')]
    public function juniorSweat(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/sweats.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/sweat-shirts', name: 'junior-sweat-shirts')]
    public function juniorSweatShirt(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/sweatshirts.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/vestes', name: 'junior-vestes')]
    public function juniorVeste(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/vestes.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/chemises', name: 'junior-chemises')]
    public function juniorChemise(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/chemises.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/t-shirts', name: 'junior-t-shirts')]
    public function juniorTshirt(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/tshirts.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/jeans', name: 'junior-jeans')]
    public function juniorJean(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/jeans.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/pantalon', name: 'junior-pantalons')]
    public function juniorPantalon(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/pantalons.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/shorts', name: 'junior-shorts')]
    public function juniorShort(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/shorts.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/jupes', name: 'junior-jupes')]
    public function juniorJupe(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/jupes.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/robes', name: 'junior-robes')]
    public function juniorRobe(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/robes.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/joggings', name: 'junior-joggings')]
    public function juniorJogging(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/joggings.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/sous-vêtements', name: 'junior-sous-vêtements')]
    public function juniorSousVetements(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/sousvetements.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/vêtements/chaussettes', name: 'junior-chaussettes')]
    public function juniorChaussette(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/vetements/chaussettes.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
    #[Route('/junior/nike', name: 'junior-nike')]
    public function juniorNike(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $juniorGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Junior']);
        $articlesJunior =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $juniorGenre]);
        return $this->render('junior/nike.html.twig', [
            'articles' => $articlesJunior
        ]);
    }
}
