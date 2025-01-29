<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Services\InstructorService;
use App\Entity\Instructor;
use Psr\Log\LoggerInterface;





final class InstructorController extends AbstractController
{
    /*

    public function __construct(private InstructorService $instructorService)
    {
    }

    #[Route('/monitors', name: 'app_instructor')]
    public function allInstructors(LoggerInterface $logger): JsonResponse
    {
        $test = $this->instructorService->getAllInstructors();
        $logger->info(json_encode($test));
        return $this->json($this->instructorService->getAllInstructors());
    }
        */
}
