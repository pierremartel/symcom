<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity("email", message : 'Cet email est déjà pris')]



class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner une adresse email')]
    #[Assert\Email(message: 'Veuillez saisir une adresse email valide',
    groups:['registration'] )]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message:'Veuillez saisir votre prénom')]
    #[Assert\Length(min:'2' , max:'45',
    minMessage:'Votre prénom doit comporter au moins 2 caracteres',
    maxMessage:'Votre prénom ne doit pas dépasser 45 caracteres',
    groups:['registration'] )]
    private $username;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message:'Veuillez saisir votre nom')]
    #[Assert\Length(min:'2' , max:'45',
    minMessage:'Votre nom doit comporter au moins 2 caracteres',
    maxMessage:'Votre nom ne doit pas dépasser 45 caracteres',
    groups:['registration'] )]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\EqualTo(propertyPath:'confirm_password', 
    message:'Les mots de passe de correspondent pas')]
    #[Assert\NotBlank(message:'Veuillez saisir votre mot de passe',
    groups:['registration'] )]
    private $password;

    #[Assert\EqualTo(propertyPath:'password', 
    message:'Les mots de passe de correspondent pas')]
    #[Assert\NotBlank(message:'Veuillez saisir votre mot de passe',
    groups:['registration'] )]
    public $confirm_password;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getSalt(){

    }

    public function eraseCredentials(){

        

    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

}



