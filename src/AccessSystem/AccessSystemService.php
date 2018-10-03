<?php

namespace Akakraft\AccessSystem;

use Doctrine\ORM\EntityManager;

class AccessSystemService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function hasRfidTokenPrivilegeToUseMachine($rfidToken, $machineAccessKey)
    {

    }
}
