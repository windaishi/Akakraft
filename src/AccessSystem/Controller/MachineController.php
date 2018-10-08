<?php
namespace Akakraft\AccessSystem\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MachineController extends Controller
{
    /**
     * @Route("/api/accessSystem/getPrivilege")
     */
    public function getPrivilege(Request $request): JsonResponse
    {
        $machineIdentifier = $request->get('machineIdentifier');

        return new JsonResponse([
            'user' => $this->getUser(),
        ]);
    }
}
