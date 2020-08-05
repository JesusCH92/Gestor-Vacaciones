<?php

namespace App\User\Domain;

use Ramsey\Uuid\Doctrine\UuidGenerator;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Department;
use App\Entity\Company;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user", options={"collate"="utf8_general_ci", "charset"="utf8"})
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{

    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(name="id_user", type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id_user;

    /**
     * @ORM\Column(type="string", name="email", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", name="user_name", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", name="last_name", length=50)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", name="phone_number", length=30)
     */
    private $phone;

    /**
     * @ORM\Column(type="json", name="roles")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", name="password")
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class)
     * @ORM\JoinColumn(nullable=false, name="id_department", referencedColumnName="id_department")
     */
    private $department;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @ORM\JoinColumn(nullable=false, name="id_company", referencedColumnName="id_company")
     */
    private $company;

    public function __construct()
    {
        $this->roles=['ROLE_USER'];
    }


    public function getId(): ?string
    {
        return $this->id_user;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @see UserInterface
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getLastname(): string
    {
        return (string) $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPhone(): string
    {
        return (string) $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

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

}
