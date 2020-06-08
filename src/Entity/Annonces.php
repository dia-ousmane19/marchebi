<?php

namespace App\Entity;

use DateTime;
use App\Repository\AnnoncesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * @ORM\Entity(repositoryClass=AnnoncesRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Annonces
{
  public const OFFER_LIFETIME = 30; // en jours
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(length=128, unique=true)
     *
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    private $prix;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime $updated_at
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="text")
     */
    private $description;



    /**
     * @ORM\Column(type="boolean")
     */
    private $prix_negociable = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $possibilite_echange = false;


    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="annonces", orphanRemoval=true,cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Etat::class, inversedBy="annonce")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity=Quartier::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quartier;

    /**
     * @ORM\ManyToOne(targetEntity=Zone::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zone;



    /**
     * @ORM\Column(type="datetime")
     */
    private $expired_at;




    public function __construct()
    {
        $this->images = new ArrayCollection();
    }
    public function __toString()
    {
      return $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }



    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
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



    public function getPrixNegociable(): ?bool
    {
        return $this->prix_negociable;
    }

    public function setPrixNegociable(bool $prix_negociable): self
    {
        $this->prix_negociable = $prix_negociable;

        return $this;
    }

    public function getPossibiliteEchange(): ?bool
    {
        return $this->possibilite_echange;
    }

    public function setPossibiliteEchange(bool $possibilite_echange): self
    {
        $this->possibilite_echange = $possibilite_echange;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setAnnonces($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getAnnonces() === $this) {
                $image->setAnnonces(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getQuartier(): ?Quartier
    {
        return $this->quartier;
    }

    public function setQuartier(?Quartier $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getExpiredAt(): ?\DateTimeInterface
    {
        return $this->expired_at;
    }

    // public function setExpiredAt(\DateTimeInterface $expired_at): self
    // {
    //     $this->expired_at = $expired_at;
    //
    //     return $this;
    // }

    /**
     * Set expired_at
     * @param LifecycleEventArgs $event
     * @ORM\PrePersist
     */
    public function setExpiredAtValue(LifecycleEventArgs $event): self
    {
        // nous remplissons automatiquement la date d'expiration si cette dernière n'a pas été saisie
        // manuellement
        if (!$this->expired_at) {
            $this->expired_at = new DateTime('+'.self::OFFER_LIFETIME.' day');
        }

        return $this;
    }




}
