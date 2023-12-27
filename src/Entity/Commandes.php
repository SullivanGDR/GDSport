<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:list','user:item'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\OneToMany(mappedBy: 'Commande', targetEntity: AjoutCommande::class, orphanRemoval: true)]
    private Collection $ajoutCommandes;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['user:list','user:item'])]
    private ?\DateTimeInterface $DateCommande = null;

    #[ORM\Column(length: 255)]
    private ?string $livraison = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['user:list','user:item'])]
    private ?\DateTimeInterface $DateLivraison = null;

    #[ORM\Column]
    private ?float $totalPrix = null;

    public function __construct()
    {
        $this->ajoutCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

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
            $ajoutCommande->setCommande($this);
        }

        return $this;
    }

    public function removeAjoutCommande(AjoutCommande $ajoutCommande): self
    {
        if ($this->ajoutCommandes->removeElement($ajoutCommande)) {
            // set the owning side to null (unless already changed)
            if ($ajoutCommande->getCommande() === $this) {
                $ajoutCommande->setCommande(null);
            }
        }

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->DateCommande;
    }

    public function setDateCommande(\DateTimeInterface $DateCommande): self
    {
        $this->DateCommande = $DateCommande;

        return $this;
    }

    public function getLivraison(): ?string
    {
        return $this->livraison;
    }

    public function setLivraison(string $livraison): self
    {
        $this->livraison = $livraison;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->DateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $DateLivraison): self
    {
        $this->DateLivraison = $DateLivraison;

        return $this;
    }

    public function getTotalPrix(): ?float
    {
        return $this->totalPrix;
    }

    public function setTotalPrix(float $totalPrix): self
    {
        $this->totalPrix = $totalPrix;

        return $this;
    }
}
