<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartmentRepository")
 */
class Department
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $departmentname;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $departmentcode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartmentname(): ?string
    {
        return $this->departmentname;
    }

    public function setDepartmentname(string $departmentname): self
    {
        $this->departmentname = $departmentname;

        return $this;
    }

    public function getDepartmentcode(): ?string
    {
        return $this->departmentcode;
    }

    public function setDepartmentcode(string $departmentcode): self
    {
        $this->departmentcode = $departmentcode;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function __toString()
    {
        return $this->departmentname;
    }
}
