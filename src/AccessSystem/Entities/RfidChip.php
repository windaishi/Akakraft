<?php
namespace Akakraft\AccessSystem\Entities;

use Akakraft\UserManagement\Entities\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * @ORM\Entity
 */
class RfidChip
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int|null
     */
    private $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="Akakraft\UserManagement\Entities\User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     * @var User
     */
    private $user;

    /**
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    private $uid;

    /**
     * @param User $user
     * @param string $uid
     * @param string $name
     */
    public function __construct(User $user, string $uid, string $name)
    {
        $this->user = $user;
        $this->name = $name;
        $this->uid = $uid;
    }

    /**
     * @return int?
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }
}
