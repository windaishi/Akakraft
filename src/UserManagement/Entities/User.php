<?php
namespace Akakraft\UserManagement\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class User implements UserInterface
{
    public const SEX_UNKNOWN = 'unbekannt';
    public const SEX_MALE = 'männlich';
    public const SEX_FEMALE = 'weiblich';
    public const SEX_OTHER = 'anderes';

    public const ROLE_ADMINISTRATOR = 'ROLE_ADMINISTRATOR';
    public const ROLE_USER_ADMINISTRATOR = 'ROLE_USER_ADMINISTRATOR';
    public const ROLE_HALL_ADMINISTRATOR = 'ROLE_HALL_ADMINISTRATOR';
    public const ROLE_USER = 'ROLE_USER';

    public const FUNCTION_HALL_ATTENDANT = 'Hallenwart';
    public const FUNCTION_CLUB_COMMITTEE = 'Vorstand';
    public const FUNCTION_DRINK_ATTENDANT = 'Getränkewart';
    public const FUNCTION_TREASURER = 'Kassenwart';
    public const FUNCTION_SECRETARY = 'Schriftführer';
    public const FUNCTION_MEMBER = 'Mitglied';

    public const CLUB_STUDENTS = 'Studentenverein';
    public const CLUB_PROMOTERS = 'Förderverein';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int|null
     */
    private $id = null;

    /**
     * @ORM\Column(type="string", unique=true)
     *
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private $passwordHash = null;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime|null
     */
    private $lastLogin = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime|null
     */
    private $lastUpdate = null;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    private $disabled = false;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @var string
     */
    private $sex = self::SEX_UNKNOWN;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $title = '';

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $firstName = '';

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $lastName = '';

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $phoneNumber = '';

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @var \DateTime|null
     */
    private $birth = null;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    private $administrator = false;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $club;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $clubFunction = self::FUNCTION_MEMBER;

    /**
     * @ORM\OneToMany(targetEntity="UserClubHistoryEntry", mappedBy="user", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     * @var ArrayCollection
     */
    private $clubHistoryEntries;

    /**
     * @ORM\OneToOne(targetEntity="UserAddress", mappedBy="user", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     * @var UserAddress
     */
    private $address;

    /**
     * @ORM\OneToOne(targetEntity="UserSettings", mappedBy="user", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     * @var UserSettings
     */
    private $settings;

    /**
     * @param string $email
     * @param string $club
     */
    public function __construct(string $email, $club)
    {
        $this->email = $email;
        $this->club = $club;
        $this->created = new \DateTime();
        $this->clubHistoryEntries = new ArrayCollection();
        $this->address = new UserAddress($this);
        $this->settings = new UserSettings($this);
    }

    /**
     * @return int?
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @inheritdoc
     */
    public function getUsername(): string
    {
        // email address ist used as username
        return $this->email;
    }

    /**
     * @return \DateTime
     */
    public function getLastLogin(): \DateTime
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTime $lastLogin
     */
    public function setLastLogin(\DateTime $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     */
    public function setDisabled(bool $disabled): void
    {
        $this->disabled = $disabled;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @param string $sex
     */
    public function setSex(string $sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return \DateTime|null
     */
    public function getBirth(): \DateTime
    {
        return $this->birth;
    }

    /**
     * @param \DateTime|null $birth
     */
    public function setBirth(\DateTime $birth): void
    {
        $this->birth = $birth;
    }

    /**
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->administrator;
    }

    /**
     * @param bool $administrator
     */
    public function setAdministrator(bool $administrator): void
    {
        $this->administrator = $administrator;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastUpdate(): ?\DateTime
    {
        return $this->lastUpdate;
    }

    /**
     * @param string $password
     * @return bool
     */
    public function verifyPassword(string $password): bool
    {
        if ($this->passwordHash === null) {
            return false;
        }

        return password_verify($password, $this->passwordHash);
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @inheritdoc
     */
    public function getPassword(): string
    {
        return $this->passwordHash;
    }

    /**
     * @inheritdoc
     */
    public function getSalt(): ?string
    {
        // The has is part of the string in $this->password;
        return null;
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateTimestamps(): void
    {
        $this->lastUpdate = new \DateTime();
    }

    /**
     * @inheritdoc
     */
    public function getRoles(): array
    {
        $roles = [self::ROLE_USER];
        if ($this->isAdministrator()) {
            $roles[] = self::ROLE_ADMINISTRATOR;
        }

        return $roles;
    }

    /**
     * @inheritdoc
     */
    public function eraseCredentials(): void
    {
        // No sensible information stored currently
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getClub(): string
    {
        return $this->club;
    }

    /**
     * @param string $club
     */
    public function setClub(string $club): void
    {
        $this->club = $club;
    }

    /**
     * @return string
     */
    public function getClubFunction(): string
    {
        return $this->clubFunction;
    }

    /**
     * @param string $clubFunction
     */
    public function setClubFunction(string $clubFunction): void
    {
        $this->clubFunction = $clubFunction;
    }

    /**
     * @return ArrayCollection
     */
    public function getClubHistoryEntries(): ArrayCollection
    {
        return $this->clubHistoryEntries;
    }

    /**
     * @param UserClubHistoryEntry $clubHistoryEntry
     */
    public function addClubHistoryEntry(UserClubHistoryEntry $clubHistoryEntry): void
    {
        $this->clubHistoryEntries->add($clubHistoryEntry);
    }

    /**
     * @param UserClubHistoryEntry $clubHistoryEntry
     */
    public function removeClubHistoryEntry(UserClubHistoryEntry $clubHistoryEntry): void
    {
        $this->clubHistoryEntries->removeElement($clubHistoryEntry);
    }

    /**
     * @return UserAddress
     */
    public function getAddress(): UserAddress
    {
        return $this->address;
    }
}
