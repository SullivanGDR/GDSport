<?php

namespace App\Entity;

use App\Repository\AjoutCommandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AjoutCommandeRepository::class)]
class AjoutCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?float $prixUnit = null;

    #[ORM\ManyToOne(inversedBy: 'ajoutCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commandes $Commande = null;

    #[ORM\ManyToOne(inversedBy: 'ajoutCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $Article = null;

    #[ORM\Column(length: 255)]
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
