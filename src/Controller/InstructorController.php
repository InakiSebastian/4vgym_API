<?php

namespace App\Controller;

use App\Model\MonitorNewDto;
use App\Services\MonitorsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;




final class InstructorController extends AbstractController
{

    public function __construct(private MonitorsService $monitorsService)
    {
        
    }

    #[Route('/monitors', name: 'app_monitor',methods:['GET'])]
    public function index(): JsonResponse
    {
        return $this->json($this->monitorsService->getMonitors());
    }

    

    #[Route('/monitors', name: 'app_monitor',methods:['POST'])]
    public function crearMonitors(#[MapRequestPayload(acceptFormat:'json',validationFailedStatusCode:  Response::HTTP_NOT_FOUND)] MonitorNewDto $monitor): JsonResponse
    {
        $monitorCreado = $this->monitorsService->crearMonitors($monitor);

        if(json_last_error() !== JSON_ERROR_NONE){
            return $this->json(['error' => 'Error en el json'], Response::HTTP_BAD_REQUEST);
        }


        return $this->json($monitorCreado);
    }
    
}
