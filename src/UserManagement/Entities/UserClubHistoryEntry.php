<?php
namespace Akakraft\UserManagement\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class UserClubHistoryEntry
{
    public const EVENT_BECOMES_GUEST = 'wird Gast';
    public const EVENT_BECOMES_CANDIDATE = 'wird Anwärter';
    public const EVENT_BECOMES_STUDENT_MEMBER = 'wird Mitglied im Studenten-Verein';
    public const EVENT_BECOMES_PROMOTER_MEMBER = 'wird Mitglied im Vörderverein';
    public const EVENT_BECOMES_HONORARY_MEMBER = 'wird Ehrenmitglied';
    public const EVENT_EXITS = 'verlässt den Verein';
    public const EVENT_DIES = 'stirbt';
    public const EVENT_STARTS_MALTE_SEMESTER = 'startet ein Malte-Semester';
    public const EVENT_ENDS_MALTE_SEMESTER = 'beendet ein Malte-Semester';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int|null
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="clubHistoryEntries")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     *
     * @var User
     */
    private $user;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $event;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $date;

    /**
     * @param User $user
     * @param string $event
     * @param \DateTime $date
     */
    public function __construct(User $user, string $event, \DateTime $date)
    {
        $this->user = $user;
        $this->user->addClubHistoryEntry($this);
        $this->event = $event;
        $this->date = $date;
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
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }
}
