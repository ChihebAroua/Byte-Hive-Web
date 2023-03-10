<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)

 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user")
     */
    private $id;

    /**
     *  @Assert\NotBlank(message=" nom doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer un nom au mini de 3 caracteres"
     *
     *     )
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.")
     * @ORM\Column(type="string", length=180, unique=true, nullable=true)
     * @Groups("user")

     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups("user")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string",nullable=true)
     * @Groups("user")
     */
    private $password;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("user")
     */
    private $lastname; 
     /**
      * @Assert\NotBlank(message=" nom doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer un nom au mini de 3 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("user")
     */
    private $name;
 /**
     * @ORM\Column(type="string", length=255, nullable=true)
      * @Assert\NotBlank(message="Please, upload the photo.") 
      * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
      *@Groups("user")
     */
    private $profilepicture;

  
  
    protected $captchaCode;
    /**
     * @ORM\Column(name="ban", type="boolean")
     * @Groups("user")
     */
    private $ban;

    /**
     * @ORM\Column(name="activate", type="boolean")
     * @Groups("user")
     */
    private $activate;


   



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function getLastname(): ?string
    {
        return $this->lastname;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function getProfilepicture()
    {
        return $this->profilepicture;
    }
 

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCaptchaCode()
    {
      return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
      $this->captchaCode = $captchaCode;
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

    public function setPassword(?string $password): self
    {
            $this->password = $password;

            return $this;
    }
 
    public function setLastname(string $lastname): self
    {
        $this->lastname= $lastname;

        return $this;
    }
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function setProfilepicture($profilepicture)
    {
        $this->profilepicture = $profilepicture;

        return $this;
    }
    public function getBan(): ?bool
    {
        return $this->ban;
    }

    public function setBan(bool $ban): self
    {
        $this->ban = $ban;

        return $this;
    }

    public function getActivate(): ?bool
    {
        return $this->activate;
    }

    public function setActivate(bool $activate): self
    {
        $this->activate = $activate;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
     
}
