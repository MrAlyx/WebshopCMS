<?php

namespace App\Entity;

use App\Repository\FactuurRegelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactuurRegelRepository::class)
 */
class FactuurRegel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantal;

    /**
     * @ORM\ManyToOne(targetEntity=Factuur::class, inversedBy="factuurRegels")
     */
    private $Factuur;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="factuurRegels")
     */
    private $Product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAantal(): ?int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }

    public function getFactuur(): ?Factuur
    {
        return $this->Factuur;
    }

    public function setFactuur(?Factuur $Factuur): self
    {
        $this->Factuur = $Factuur;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->Product;
    }

    public function setProduct(?Product $Product): self
    {
        $this->Product = $Product;

        return $this;
    }
}
