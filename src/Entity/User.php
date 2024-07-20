<?php


namespace App\Entity;


use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

/**
 * @method string getUserIdentifier()
 */
class User implements UserInterface, UserPasswordEncoderInterface

{
    private string $id;
    private string $name;
    private string $username;
    private string $password;
    private \DateTime $created_at;
    private \DateTime $updated_at;
    private bool $isAdmin;


    public function __construct(
        string $name,
        string $username,
        bool $isAdmin=false)
    {
        $this->id=Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->username = $username;
        $this->created_at = new \DateTime('now');
        $this->updated_at = new \DateTime('now');
        $this->isAdmin = $isAdmin;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getCreated(): \DateTime
    {
        return $this->created_at;
    }

    public function getUpdated(): \DateTime
    {
        return $this->updated_at;
    }

    public function markAsUpdated(): void
    {


        $this->updated_at = new \DateTime();


    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }

    public function toArray():array
    {
        return [
            'id'=>$this->id,
            'username'=>$this->username,
            'name'=>$this->name,
            'created'=>$this->created_at->format('d-m-y'),
            'updated'=>$this->updated_at->format('d-m-y'),
            'isAdmin'=>$this->isAdmin
        ];
    }


    public function getRoles():array
    {
        return [];
    }

    public function getSalt():void
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials():void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function __call($name, $arguments):void
    {
        // TODO: Implement @method string getUserIdentifier()
    }

    public function encodePassword(UserInterface $user, string $plainPassword)
    {
        // TODO: Implement encodePassword() method.
    }

    public function isPasswordValid(UserInterface $user, string $raw)
    {
        // TODO: Implement isPasswordValid() method.
    }

    public function needsRehash(UserInterface $user): bool
    {
        // TODO: Implement needsRehash() method.
    }

}