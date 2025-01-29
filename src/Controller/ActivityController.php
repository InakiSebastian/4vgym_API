<?php

namespace App\Controller;

use App\Model\ActivityNewDTO;
use App\Services\ActivityService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[Route('/activities')]
class ActivityController extends AbstractController
{
    public function __construct(private ActivityService $service) {}


    #[Route('', name: 'get_activities', methods: ['GET'])]
    public function getAll(
        #[MapQueryParameter] ?string $date
    ): JsonResponse {
        if ($date) {
            $dateObj = DateTime::createFromFormat('d-m-Y', $date);
            if (!$dateObj) {
                return $this->json(["error" => "Invalid date format. Use dd-MM-yyyy."], Response::HTTP_BAD_REQUEST);
            }
            $activities = $this->service->findActivities($dateObj);
        } else {
            $activities = $this->service->findActivities(null);
        }
        return $this->json($activities);
    }


    #[Route('', name: 'post_activity', methods: ['POST'])]
    public function addActivity(
        #[MapRequestPayload] ActivityNewDTO $activityNewDTO
    ): JsonResponse {
        $created = $this->service->addActivity($activityNewDTO);
        return $this->json($created, Response::HTTP_OK);
    }


    #[Route('/{activityId}', name: 'put_activity', methods: ['PUT'])]
    public function updateActivity(
        int $activityId,
        #[MapRequestPayload] ActivityNewDTO $activityNewDTO
    ): JsonResponse {
        $updated = $this->service->updateActivity($activityId, $activityNewDTO);
        if (!$updated) {
            return $this->json(["error" => "Activity not found"], Response::HTTP_NOT_FOUND);
        }
        return $this->json($updated);
    }


    #[Route('/{activityId}', name: 'delete_activity', methods: ['DELETE'])]
    public function deleteActivity(int $activityId): JsonResponse
    {
        $deleted = $this->service->deleteActivity($activityId);
        if (!$deleted) {
            return $this->json(["error" => "Activity not found"], Response::HTTP_NOT_FOUND);
        }
        return $this->json(["message" => "Activity deleted successfully"]);
    }
}
