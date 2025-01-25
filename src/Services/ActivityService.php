<?php

namespace App\Services;

use App\Entity\Activity;
use App\Entity\ActivityInstructor;
use App\Model\ActivityDTO;
use App\Model\ActivityNewDTO;
use App\Model\InstructorDTO;
use App\Model\ActivityTypeDTO;
use App\Repository\ActivityRepository;
use App\Repository\ActivityInstructorRepository;
use App\Repository\ActivityTypeRepository;
use App\Repository\InstructorRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ActivityService
{
    
    public function __construct(
        private ActivityRepository $activityRepository,
        private ActivityInstructorRepository $activityInstructorRepository,
        private ActivityTypeRepository $activityTypeRepository,
        private InstructorRepository $instructorRepository,
        private EntityManagerInterface $entityManager
    ) {}


    public function getAllActivities(): array
    {
        $activities = $this->activityRepository->findAll();
        
        return array_map(function (Activity $activity) {
            return new ActivityDTO(
                id: $activity->getId(),
                date: $activity->getDate(),
                duration: $activity->getDuration(),
                activityType: new ActivityTypeDTO(
                    id: $activity->getActivityType()->getId(),
                    name: $activity->getActivityType()->getName(),
                    instructorsNumber: $activity->getActivityType()->getRequiredInstructors(),
                    icon: "icono.png"
                ),
                instructors: array_map(fn ($ai) => new InstructorDTO(
                    id: $ai->getInstructor()->getId(),
                    name: $ai->getInstructor()->getName(),
                    mail: $ai->getInstructor()->getEmail(),
                    phone: $ai->getInstructor()->getTelf()
                ), $this->activityInstructorRepository->findBy(['activity' => $activity]))
            );
        }, $activities);
    }


    public function getActivitiesByDate(DateTime $date): array
    {
        $activities = $this->activityRepository->findBy(['date' => $date]);
        return $this->getAllActivities($activities);
    }


    public function addActivity(ActivityNewDTO $newActivity): ActivityDTO
    {
        $activityType = $this->activityTypeRepository->find($newActivity->activityTypeId);
        if (!$activityType) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, "El tipo de actividad no es válido.");
        }
        $instructors = $this->instructorRepository->findBy(['id' => $newActivity->instructorIds]);
        if (count($instructors) < $activityType->getRequiredInstructors()) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, "No hay suficientes monitores para esta actividad.");
        }
        $activityEntity = new Activity();
        $activityEntity->setDate($newActivity->date);
        $activityEntity->setDuration($newActivity->duration);
        $activityEntity->setActivityType($activityType);
        $this->entityManager->persist($activityEntity);
        $this->entityManager->flush();
        foreach ($instructors as $instructor) {
            $activityInstructor = new ActivityInstructor();
            $activityInstructor->setActivity($activityEntity);
            $activityInstructor->setInstructor($instructor);
            $this->entityManager->persist($activityInstructor);
        }
        $this->entityManager->flush();

        return new ActivityDTO(
            id: $activityEntity->getId(),
            date: $activityEntity->getDate(),
            duration: $activityEntity->getDuration(),
            activityType: new ActivityTypeDTO(
                id: $activityEntity->getActivityType()->getId(),
                name: $activityEntity->getActivityType()->getName(),
                instructorsNumber: $activityEntity->getActivityType()->getRequiredInstructors(),
                icon: "icono.png"
            ),
            instructors: array_map(fn ($ai) => new InstructorDTO(
                id: $ai->getInstructor()->getId(),
                name: $ai->getInstructor()->getName(),
                mail: $ai->getInstructor()->getEmail(),
                phone: $ai->getInstructor()->getTelf()
            ), $this->activityInstructorRepository->findBy(['activity' => $activityEntity]))
        );
    }


    public function deleteActivity(int $id): bool
    {
        $activity = $this->activityRepository->find($id);
        if (!$activity) {
            return false;
        }
        $this->entityManager->remove($activity);
        $this->entityManager->flush();
        return true;
    }

    public function editActivity(int $id, ActivityNewDTO $activityNewDTO): ?ActivityDTO
    {
        $activity = $this->activityRepository->find($id);
        if (!$activity) {
            return null;
        }
        $activityType = $this->activityTypeRepository->find($activityNewDTO->activityTypeId);
        if (!$activityType) {
            return null;
        }
        $activity->setDate($activityNewDTO->date);
        $activity->setDuration($activityNewDTO->duration);
        $activity->setActivityType($activityType);

        $this->entityManager->flush();

        return new ActivityDTO(
            id: $activity->getId(),
            date: $activity->getDate(),
            duration: $activity->getDuration(),
            activityType: new ActivityTypeDTO(
                id: $activityType->getId(),
                name: $activityType->getName(),
                instructorsNumber: $activityType->getRequiredInstructors(),
                icon: "icono.png"
            ),
            instructors: []
        );
    }
}
