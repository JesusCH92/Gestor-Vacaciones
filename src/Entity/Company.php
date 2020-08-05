<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 * @ORM\Table(name="company", options={"collate"="utf8_general_ci", "charset"="utf8"})
 */
class Company
{
    const COMPANYTABLE = 'company';
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id_company")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, name="company_name")
     */
    private $companyname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyname(): ?string
    {
        return $this->companyname;
    }

    public function setCompanyname(string $companyname): self
    {
        $this->companyname = $companyname;

        return $this;
    }

    public function __toString()
    {
        return $this->companyname;
    }
}
