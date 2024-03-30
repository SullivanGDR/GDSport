<?php

namespace App\Entity;

use App\Repository\AjoutCommandeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;

#[ApiResource(operations:[
    new GetCollection(normalizationContext:['groups'=>'ajoutCommande:list']),
    new Get(normalizationContext:['groups'=>'ajoutCommande:item']),
    new Post(),
])]
#[ORM\Entity(repositoryClass: AjoutCommandeRepository::class)]
class AjoutCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['ajoutCommande:list','ajoutCommande:item'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['ajoutCommande:list','ajoutCommande:item'])]
    private ?int $quantite = null;

    #[ORM\Column]
    #[Groups(['ajoutCommande:list','ajoutCommande:item'])]
    private ?float $prixUnit = null;

    #[ORM\ManyToOne(inversedBy: 'ajoutCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['ajoutCommande:list','ajoutCommande:item'])]
    private ?Commandes $Commande = null;

    #[ORM\ManyToOne(inversedBy: 'ajoutCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['ajoutCommande:list','ajoutCommande:item'])]
    private ?Article $Article = null;

    #[ORM\Column(length: 255)]
    #[Groups(['ajoutCommande:list','ajoutCommande:item'])]
    private ?string $taille = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixUnit(): ?float
    {
        return $this->prixUnit;
    }

    public function setPrixUnit(float $prixUnit): self
    {
        $this->prixUnit = $prixUnit;

        return $this;
    }

    public function getCommande(): ?Commandes
    {
        return $this->Commande;
    }

    public function setCommande(?Commandes $Commande): self
    {
        $this->Commande = $Commande;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->Article;
    }

    public function setArticle(?Article $Article): self
    {
        $this->Article = $Article;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }
}
