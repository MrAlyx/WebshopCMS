<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $omschrijving;

    /**
     * @ORM\Column(type="float")
     */
    private $prijs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $frontpage;

    /**
     * @ORM\ManyToOne(targetEntity=btw::class, inversedBy="products")
     */
    private $btw;

    /**
     * @ORM\OneToMany(targetEntity=FactuurRegel::class, mappedBy="Product")
     */
    private $factuurRegels;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="Product")
     */
    private $images;

    public function __construct()
    {
        $this->factuurRegels = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(float $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getFrontpage(): ?bool
    {
        return $this->frontpage;
    }

    public function setFrontpage(bool $frontpage): self
    {
        $this->frontpage = $frontpage;

        return $this;
    }

    public function getBtw(): ?btw
    {
        return $this->btw;
    }

    public function setBtw(?btw $btw): self
    {
        $this->btw = $btw;

        return $this;
    }

    /**
     * @return Collection|FactuurRegel[]
     */
    public function getFactuurRegels(): Collection
    {
        return $this->factuurRegels;
    }

    public function addFactuurRegel(FactuurRegel $factuurRegel): self
    {
        if (!$this->factuurRegels->contains($factuurRegel)) {
            $this->factuurRegels[] = $factuurRegel;
            $factuurRegel->setProduct($this);
        }

        return $this;
    }

    public function removeFactuurRegel(FactuurRegel $factuurRegel): self
    {
        if ($this->factuurRegels->contains($factuurRegel)) {
            $this->factuurRegels->removeElement($factuurRegel);
            // set the owning side to null (unless already changed)
            if ($factuurRegel->getProduct() === $this) {
                $factuurRegel->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProduct($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getProduct() === $this) {
                $image->setProduct(null);
            }
        }

        return $this;
    }
}
