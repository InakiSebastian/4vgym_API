<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Services\ActivityTypeService;

#[Route('/activity-types')]
class ActivityTypeController extends AbstractController
{
    public function __construct(private ActivityTypeService $typeService) {}

    #[Route('', name: 'get_activity_types', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $types = $this->typeService->findAll();
        return $this->json($types);
    }
}
