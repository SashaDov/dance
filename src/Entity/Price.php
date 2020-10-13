<?php

namespace App\Entity;

use App\dbal\EnumMetallType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $supplier_id;

    /**
     * enum ('Gold', 'Silver', 'Platinum')
     * @ORM\Column(type="metallenum", length=20, nullable=false)
     */
    private $metal_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplierId(): ?int
    {
        return $this->supplier_id;
    }

    public function setSupplierId(int $supplier_id): self
    {
        $this->supplier_id = $supplier_id;

        return $this;
    }

    /**
     * @return EnumMetallType
     */
    public function getMetalType()
    {
        return $this->metal_type;
    }

    public function setMetalType($metal_type)
    {
        $this->metal_type = $metal_type;

        return $this;
    }

    public function getPrice(): \Money\Money
    {
        return $this->price;
    }

//    public function setPrice(string $price, string $currencyCode): self
//    {
//        $this->price = new \Money\Money($price, new \Money\Currency($currencyCode));
//
//        return $this;
//    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
