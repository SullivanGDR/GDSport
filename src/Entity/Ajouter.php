<?php

namespace App\Entity;

use App\Repository\AjouterRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;

#[ApiResource(operations:[
    new Patch(normalizationContext:['groups'=>'ajout:item'],security:"is_granted('ROLE_ADMIN') or object==user"),
    new Delete(normalizationContext:['groups'=>'ajout:item'],security:"is_granted('ROLE_ADMIN') or object==user"),
])]
#[ORM\Entity(repositoryClass: AjouterRepository::class)]
class Ajouter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:list','user:item','ajout:item'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['user:list','user:item','ajout:item'])]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'ajouters')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['user:list','user:item','ajout:item'])]
    private ?Article $produit = null;

    #[ORM\ManyToOne(inversedBy: 'ajouters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Panier $panier = null;

    #[ORM\Column(length: 20)]
    #[Groups(['user:list','user:item','ajout:item'])]
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

    public function getProduit(): ?Article
    {
        return $this->produit;
    }

    public function setProduit(?Article $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): self
    {
        $this->panier = $panier;

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
