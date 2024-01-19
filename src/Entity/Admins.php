<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AdminsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;

#[ORM\Entity(repositoryClass: AdminsRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['admins:list']]
        ),
        new Get(
            normalizationContext: ['groups' => ['admins:item']],
        ),
        new Post(
           
            denormalizationContext: ['groups' => ['admins:write']]
        ),
        new Put(
            normalizationContext: ['groups' => ['admins:update']],
            denormalizationContext: ['groups' => ['admins:write']]
        ),
        new Delete()
    ]
)]
class Admins
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
  
    #[ORM\Column(length: 255)]
    #[Groups(["admins:list","admins:write"])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(["admins:list","admins:write"])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(["admins:write"])]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }
}