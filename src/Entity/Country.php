<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $country_name;

    #[ORM\Column(type: 'string', length: 2)]
    private $country_code;

    #[ORM\Column(type: 'integer')]
    private $country_tax;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountryName(): ?string
    {
        return $this->country_name;
    }

    public function setCountryName(string $country_name): self
    {
        $this->country_name = $country_name;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $country_code): self
    {
        $this->country_code = $country_code;

        return $this;
    }

    public function getCountryTax(): ?int
    {
        return $this->country_tax;
    }

    public function setCountryTax(int $country_tax): self
    {
        $this->country_tax = $country_tax;

        return $this;
    }
}
