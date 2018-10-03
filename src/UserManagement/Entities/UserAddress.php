<?php
namespace Akakraft\UserManagement\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class UserAddress
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
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $street = '';

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $addressAddition = '';

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $zipCode = '';

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $city = '';

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $country = '';

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getAddressAddition(): string
    {
        return $this->addressAddition;
    }

    /**
     * @param string $addressAddition
     */
    public function setAddressAddition(string $addressAddition): void
    {
        $this->addressAddition = $addressAddition;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }
}
