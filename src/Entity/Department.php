<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartmentRepository")
 * @ORM\Table(name="department", options={"collate"="utf8_general_ci", "charset"="utf8"})
 */
class Department
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id_department")
     */
    private $departmentId;

    /**
     * @ORM\Column(type="string", name="department_name", length=50)
     */
    private $departmentName;

    /**
     * @ORM\Column(type="string", name="department_code", length=10)
     */
    private $departmentCode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company")
     * @ORM\JoinColumn(nullable=false, name="id_company", referencedColumnName="id_company")
     */
    private $company;

    public function __construct(string $departmentName, string $departmentCode, Company $company)
    {
        $this->departmentName = $departmentName;
        $this->departmentCode = $departmentCode;
        $this->company = $company;
    }

    public function departmentId(): ?int
    {
        return $this->departmentId;
    }

    public function departmentName(): ?string
    {
        return $this->departmentName;
    }

    public function departmentCode(): ?string
    {
        return $this->departmentCode;
    }

    public function company(): ?Company
    {
        return $this->company;
    }

    public function __toString()
    {
        return $this->departmentName;
    }
}
