<?php

namespace App\Controller;

use App\Model\ActivityNewDTO;
use App\Services\ActivityService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpFoundation\Response;

final class ActivityController extends AbstractController
{
    public function __construct(private ActivityService $activityService) {}
    /*
    #[Route('/activities', name: 'get_activities', methods: ['GET'])]
    public function getActivities(): JsonResponse
    {
        $allActivities = $this->activityService->getAllActivities();

        if (empty($allActivities)) {
            return $this->json(["error" => "No hay actividades disponibles"], Response::HTTP_NOT_FOUND);
        }
        return $this->json($allActivities);
    }

    #[Route('/activities-date/{date}', name: 'get_activities_bydate', methods:['GET'])]
    public function getActivitiesByDate(string $date, LoggerInterface $logger): JsonResponse
    {
        $dateObj = DateTime::createFromFormat('Y-m-d', $date);

        if (!$dateObj) {
            return $this->json(["error" => "Formato de fecha inválido. Use YYYY-MM-DD."], Response::HTTP_BAD_REQUEST);
        }

        $activitiesByDate = $this->activityService->getActivitiesByDate($dateObj);

        if (empty($activitiesByDate)) {
            return $this->json(["error" => "No hay actividades para la fecha: $date"], Response::HTTP_NOT_FOUND);
        }

        return $this->json($activitiesByDate);
    }

    #[Route('/new-activity', name: 'post_activity', methods: ['POST'])]
    public function newActivity(
        #[MapRequestPayload(validationFailedStatusCode: Response::HTTP_BAD_REQUEST)]
        ActivityNewDTO $activityNewDTO
    ): JsonResponse {
        $createdActivity = $this->activityService->addActivity($activityNewDTO);
        return $this->json($createdActivity, Response::HTTP_CREATED);
    }

    #[Route('/activity-edit/{id}', name: 'put_edit_activity', methods:['PUT'])]
    public function editActivity(int $id, #[MapRequestPayload] ActivityNewDTO $activityNewDTO): JsonResponse
    {
        $updatedActivity = $this->activityService->editActivity($id, $activityNewDTO);

        if (!$updatedActivity) {
            return $this->json(["error" => "Actividad no encontrada"], Response::HTTP_NOT_FOUND);
        }

        return $this->json($updatedActivity);
    }

    #[Route('/activity-delete/{id}', name: 'delete_activity', methods:['DELETE'])]
    public function deleteActivity(int $id): JsonResponse
    {
        $deleted = $this->activityService->deleteActivity($id);

        if (!$deleted) {
            return $this->json(["error" => "Actividad no encontrada"], Response::HTTP_NOT_FOUND);
        }

        return $this->json(["message" => "Actividad eliminada con éxito"]);
    }


    // METODOS HARDCODED PRUEBA!!

    #[Route('/new-activity-hardcoded', name: 'post_activity_hardcoded', methods: ['POST'])]
    public function newHardcodedActivity(): JsonResponse
    {
        $createdActivity = $this->activityService->addHardcodedActivity();

        return $this->json($createdActivity, Response::HTTP_CREATED);
    }

    #[Route('/activity-edit-hardcoded', name: 'put_edit_activity_hardcoded', methods:['PUT'])]
    public function editHardcoded(): JsonResponse
    {
        $updatedActivity = $this->activityService->editHardcodedActivity();

        if (!$updatedActivity) {
            return $this->json(["error" => "Actividad no encontrada"], Response::HTTP_NOT_FOUND);
        }

        return $this->json($updatedActivity);
    }

    #[Route('/activity-delete-hardcoded', name: 'delete_activity_hardcoded', methods:['DELETE'])]
    public function deleteActivityHard(): JsonResponse
    {
        $deleted = $this->activityService->deleteActivityHardcoded();

        if (!$deleted) {
            return $this->json(["error" => "Actividad no encontrada"], Response::HTTP_NOT_FOUND);
        }

        return $this->json(["message" => "Actividad eliminada con éxito"]);
    }
        */
}
