<?php

namespace App\Controller;

use App\Services\ActivityTypeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpFoundation\Response;

final class ActivityTypeController extends AbstractController
{
    public function __construct(private ActivityTypeService $activityTypeService){}

     #[Route('/activities', name: 'get_activities', methods: ['GET'])]
    public function getRestaurants(#[MapQueryParameter] string $tipo = null): JsonResponse
    {
        return $this->json($this->activityTypeService->getAllActivityTypes());
    }
}
