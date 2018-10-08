<?php

namespace Akakraft\UserManagement;

use Akakraft\UserManagement\Entities\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserRepository extends EntityRepository implements UserProviderInterface
{
    /**
     * @inheritdoc
     */
    public function loadUserByUsername($username): UserInterface
    {
        /** @var User|null $user */
        $user = $this->findOneBy([
            'email' => $username,
        ]);

        if (!$user) {
            throw new UsernameNotFoundException(sprintf('User with username/email %s not found', $username));
        }

        return $user;
    }

    /**
     * @inheritdoc
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$this->supportsClass(\get_class($user))) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }
        
        $this->getEntityManager()->refresh($user);
        
        return $user;
    }

    /**
     * @inheritdoc
     */
    public function supportsClass($class): bool
    {
        return $class === User::class;
    }
}
