<?php

namespace App\Controller;

use App\Services\ActivityTypeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;

final class ActivityTypeController extends AbstractController
{
    /*
    public function __construct(private ActivityTypeService $activityTypeService){}

     #[Route('/activity-types', name: 'get_activity_types', methods: ['GET'])]
    public function getRestaurants(#[MapQueryParameter] string $tipo = null): JsonResponse
    {
        return $this->json($this->activityTypeService->getAllActivityTypes());
    }
    */
}
