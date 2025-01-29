<?php

namespace App\Controller;

use App\Model\MonitorNewDto;
use App\Services\MonitorsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class MonitorController extends AbstractController
{

    public function __construct(private MonitorsService $monitorsService)
    {
        
    }

    #[Route('/monitors', name: 'getMonitor',methods:['GET'])]
    public function index(): JsonResponse
    {
        return $this->json($this->monitorsService->getMonitors());
    }



    #[Route('/monitors', name: 'addMonitor',methods:['POST'])]
    public function addMonitor(#[MapRequestPayload(acceptFormat:'json',validationFailedStatusCode:Response::HTTP_NOT_FOUND)]MonitorNewDto $monitorNewDto): JsonResponse
    {

        $monitorCreado = $this->monitorsService->crearMonitors($monitorNewDto);
        return $this->json($monitorCreado);
    }

    #[Route('/monitors/{idMonitor}', name: 'editMonitor',methods:['PUT'])]
    public function updateMonitor(#[MapRequestPayload(acceptFormat:'json',validationFailedStatusCode:Response::HTTP_NOT_FOUND)]MonitorNewDto $monitorNewDto, String $idMonitor): JsonResponse
    {
        $monitorActualizado = $this->monitorsService->updateMonitor($monitorNewDto, (int)$idMonitor);
        if($monitorActualizado == null){
            return $this->json(["message"=>"Monitor no encontrado"],Response::HTTP_NOT_FOUND);

        }
        return $this->json($monitorActualizado);
    }


}
