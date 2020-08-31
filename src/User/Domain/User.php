<?php

namespace App\User\Domain;

use Ramsey\Uuid\Doctrine\UuidGenerator;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
// use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Department;
use App\Entity\Company;
use App\User\Domain\ValueObject\Roles;
use Ramsey\Uuid\Nonstandard\Uuid;

/**
 * @ORM\MappedSuperclass
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_user", type="uuid", unique=true)
     */
    protected $userId;

    /**
     * @ORM\Column(type="string", name="email", length=180, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", name="user_name", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", name="last_name", length=50)
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string", name="phone_number", length=30)
     */
    protected $phone;

    /**
     * @ORM\Embedded(class="App\User\Domain\ValueObject\Roles", columnPrefix = false)
     */
    protected $roles;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", name="password")
     */
    protected $password;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class)
     * @ORM\JoinColumn(nullable=false, name="id_department", referencedColumnName="id_department")
     */
    protected $department;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @ORM\JoinColumn(nullable=false, name="id_company", referencedColumnName="id_company")
     */
    protected $company;

    public function __construct(string $email, string $name, string $lastname, string $phone, Roles $roles, string $password, Department $department, Company $company)
    {
        $this->userId = Uuid::uuid4();
        $this->email = $email;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->phone = $phone;
        $this->roles = $roles;
        $this->password = $password;
        $this->department = $department;
        $this->company = $company;
    }


    public function userId(): ?string
    {
        return $this->userId;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function lastname(): string
    {
        return $this->lastname;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function roles(): Roles
    {
        return $this->roles;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }
}
