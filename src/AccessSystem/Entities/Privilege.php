<?php
namespace Akakraft\AccessSystem\Entities;

use Akakraft\UserManagement\Entities\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * If a User has a Privilege for a Machine he is allowed to use it.
 *
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={
 *     @ORM\UniqueConstraint(name="user_machine", columns={"userId", "machineId"}),
 * })
 */
class Privilege
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int|null
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Akakraft\UserManagement\Entities\User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     * @var User
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Machine")
     * @ORM\JoinColumn(name="machineId", referencedColumnName="id")
     * @var Machine
     */
    private $machine;

    /**
     * @param User $user
     * @param Machine $machine
     */
    public function __construct(User $user, Machine $machine)
    {
        $this->user = $user;
        $this->machine = $machine;
    }

    /**
     * @return int|null
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
     * @return Machine
     */
    public function getMachine(): Machine
    {
        return $this->machine;
    }
}
