<?php
namespace Akakraft\UserManagement\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class UserSettings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int|null
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="address")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @var User
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    private $remindForCleaningDuty = true;

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
     * @return bool
     */
    public function isRemindForCleaningDuty(): bool
    {
        return $this->remindForCleaningDuty;
    }

    /**
     * @param bool $remindForCleaningDuty
     */
    public function setRemindForCleaningDuty(bool $remindForCleaningDuty): void
    {
        $this->remindForCleaningDuty = $remindForCleaningDuty;
    }
}
