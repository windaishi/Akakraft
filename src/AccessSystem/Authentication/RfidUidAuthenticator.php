<?php
namespace Akakraft\AccessSystem\Authentication;

use Akakraft\AccessSystem\Entities\RfidChip;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class RfidUidAuthenticator extends AbstractGuardAuthenticator
{
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new Response('Auth header required', 401);
    }

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

    public function supports(Request $request)
    {
        return $request->headers->has('X-AKAKRAFT-RFID-UID');
    }

    public function getCredentials(Request $request)
    {
        return $request->headers->get('X-AKAKRAFT-RFID-UID');
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        /** @var RfidChip $rfidChip */
        $rfidChip = $this->entityManager->getRepository(RfidChip::class)->findOneBy([
            'uid' => $credentials,
        ]);

        if (!$rfidChip) {
            return null;
        }

        return $rfidChip->getUser();
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $user !== null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse([
            'message' => $exception->getMessage(),
        ]);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
