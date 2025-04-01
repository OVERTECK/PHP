<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 2, max: 255, minMessage: "Ошибка! Длина имени должна составлять от 2 до 255 символов.")]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 2, max: 255, minMessage: "Ошибка! Поле фамилии должно содержать от 2 до 255 символов.")]
    private ?string $last_name = null;

    #[ORM\Column(length: 10, nullable: true)]
    #[Assert\NotBlank(message: "Ошибка! Поле возраста не должно быть пустым")]
    #[Assert\Range(
        notInRangeMessage: "Ошибка! Возраст может быть от 1 до 255.",
        min: 1,
        max: 255)]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Ошибка! Поле статуса не должно быть пустым.")]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(message: "Ошибка! Формат электронной почты неверный.")]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Regex('/@[a-z\d_]{5, 30}/', message: 'Ошибка! Формат телеграма неверный.')]
    private ?string $telegram = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Ошибка! Поле адреса не должно быть пустым.")]
    private ?string $address = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Department $department = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pathToImage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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

    public function getTelegram(): ?string
    {
        return $this->telegram;
    }

    public function setTelegram(?string $telegram): static
    {
        $this->telegram = $telegram;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): static
    {
        $this->department = $department;

        return $this;
    }

    public function getPathToImage(): ?string
    {
        return $this->pathToImage;
    }

    public function setPathToImage(?string $pathToImage): static
    {
        $this->pathToImage = $pathToImage;

        return $this;
    }
}
