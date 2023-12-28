<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;

#[ApiResource(operations:[
    new GetCollection(normalizationContext:['groups'=>'article:list']),
    new Get(normalizationContext:['groups'=>'article:item'])
])]
#[ApiFilter(BooleanFilter::class, properties: ['tendance'])]
#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['article:list','article:item','user:list','user:item'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['article:list','article:item','user:list','user:item'])]
    private ?int $prix = null;

    #[ORM\Column(length: 255)]
    #[Groups(['article:list','article:item','user:list','user:item'])]
    private ?string $designation = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['article:list','article:item'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['article:list','article:item','user:list','user:item'])]
    private ?Genre $genre = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['article:list','article:item'])]
    private ?Type $type = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: ImagesArticle::class, orphanRemoval: true)]
    #[Groups(['article:list','article:item','user:list','user:item'])]
    private Collection $image;

    #[ORM\Column]
    #[Groups(['article:list','article:item'])]
    private ?int $nbFavoris = null;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Ajouter::class)]
    private Collection $ajouters;

    #[ORM\OneToMany(mappedBy: 'Article', targetEntity: AjoutCommande::class)]
    private Collection $ajoutCommandes;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: ArticleTaille::class, orphanRemoval: true)]
    #[Groups(['article:list','article:item'])]
    private Collection $tailles;

    #[ORM\Column(length: 255)]
    #[Groups(['article:list','article:item'])]
    private ?string $marque = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Avis::class)]
    #[Groups(['article:list','article:item'])]
    private Collection $avis;

    #[ORM\Column]
    #[Groups(['article:list','article:item'])]
    private ?float $note = null;

    #[ORM\Column]
    #[Groups(['article:list','article:item'])]
    private ?bool $tendance = null;

    public function __construct()
    {
        $this->image = new ArrayCollection();
        $this->ajouters = new ArrayCollection();
        $this->ajoutCommandes = new ArrayCollection();
        $this->tailles = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, ImagesArticle>
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(ImagesArticle $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image->add($image);
            $image->setArticle($this);
        }

        return $this;
    }

    public function removeImage(ImagesArticle $image): self
    {
        if ($this->image->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getArticle() === $this) {
                $image->setArticle(null);
            }
        }

        return $this;
    }

    public function getNbFavoris(): ?int
    {
        return $this->nbFavoris;
    }

    public function setNbFavoris(int $nbFavoris): self
    {
        $this->nbFavoris = $nbFavoris;

        return $this;
    }

    /**
     * @return Collection<int, Ajouter>
     */
    public function getAjouters(): Collection
    {
        return $this->ajouters;
    }

    public function addAjouter(Ajouter $ajouter): self
    {
        if (!$this->ajouters->contains($ajouter)) {
            $this->ajouters->add($ajouter);
            $ajouter->setProduit($this);
        }

        return $this;
    }

    public function removeAjouter(Ajouter $ajouter): self
    {
        if ($this->ajouters->removeElement($ajouter)) {
            // set the owning side to null (unless already changed)
            if ($ajouter->getProduit() === $this) {
                $ajouter->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AjoutCommande>
     */
    public function getAjoutCommandes(): Collection
    {
        return $this->ajoutCommandes;
    }

    public function addAjoutCommande(AjoutCommande $ajoutCommande): self
    {
        if (!$this->ajoutCommandes->contains($ajoutCommande)) {
            $this->ajoutCommandes->add($ajoutCommande);
            $ajoutCommande->setArticle($this);
        }

        return $this;
    }

    public function removeAjoutCommande(AjoutCommande $ajoutCommande): self
    {
        if ($this->ajoutCommandes->removeElement($ajoutCommande)) {
            // set the owning side to null (unless already changed)
            if ($ajoutCommande->getArticle() === $this) {
                $ajoutCommande->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ArticleTaille>
     */
    public function getTailles(): Collection
    {
        return $this->tailles;
    }

    public function addTaille(ArticleTaille $taille): self
    {
        if (!$this->tailles->contains($taille)) {
            $this->tailles->add($taille);
            $taille->setArticle($this);
        }

        return $this;
    }

    public function removeTaille(ArticleTaille $taille): self
    {
        if ($this->tailles->removeElement($taille)) {
            // set the owning side to null (unless already changed)
            if ($taille->getArticle() === $this) {
                $taille->setArticle(null);
            }
        }

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setArticle($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getArticle() === $this) {
                $avi->setArticle(null);
            }
        }

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function isTendance(): ?bool
    {
        return $this->tendance;
    }

    public function setTendance(bool $tendance): static
    {
        $this->tendance = $tendance;

        return $this;
    }
}
