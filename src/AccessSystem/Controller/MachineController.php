<?php
namespace Akakraft\AccessSystem\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MachineController extends Controller
{
    /**
     * @Route("/api/machine/privilege")
     */
    public function hasPrivileges(): JsonResponse
    {
        $this->get('accessSystem');

        return new JsonResponse([
            'success' => true,
        ]);
    }
}
