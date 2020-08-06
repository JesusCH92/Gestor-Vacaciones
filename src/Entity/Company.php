<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
    private $companyId;

    /**
     * @ORM\Column(type="string", length=50, name="company_name")
     */
    private $companyName;

    public function companyId(): ?int
    {
        return $this->companyId;
    }

    public function companyName(): ?string
    {
        return $this->companyName;
    }

    public function __toString()
    {
        return $this->companyName;
    }
}
