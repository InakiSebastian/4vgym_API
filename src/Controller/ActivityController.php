<?php

namespace App\Controller;

use App\Services\ActivityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpFoundation\Response;

final class ActivityController extends AbstractController
{
    public function __construct(private ActivityService $activityService){}


    #[Route('/activities', name: 'get_activities', methods: ['GET'])]
    public function getRestaurants(#[MapQueryParameter] string $tipo = null): JsonResponse
    {
        return $this->json("");
    }

    #[Route('/activities-date/{date}', name: 'get_activities_bydate', methods:['GET'])]
    public function getActivitiesByDate(String $date, LoggerInterface $logger): JsonResponse
    {
        $activitiesByDate = $this->activityService->getAllActivities();
        
        if (!isset($activitiesByDate[$date])) {
            return $this->json(["error" => "No hay ninguna activdatead que coincdatea con la fecha: $date"], Response::HTTP_NOT_FOUND);
        }

        return $this->json($activitiesByDate[$date]);
    }


}
