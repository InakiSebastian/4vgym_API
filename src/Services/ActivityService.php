<?php

namespace App\Services;

/*
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
*/

class ActivityService
{
    /*
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
    $allowedStartTimes = ['09:00', '13:30', '17:30'];
    $formattedTime = $newActivity->date->format('H:i');

    if (!in_array($formattedTime, $allowedStartTimes)) {
        throw new HttpException(Response::HTTP_BAD_REQUEST, "Invalid start time. Allowed times are 09:00, 13:30, and 17:30.");
    }

    if ($newActivity->duration !== 90) {
        throw new HttpException(Response::HTTP_BAD_REQUEST, "Invalid duration. Activities must be exactly 90 minutes long.");
    }

    $activityType = $this->activityTypeRepository->find($newActivity->activityTypeId);
    if (!$activityType) {
        throw new HttpException(Response::HTTP_BAD_REQUEST, "The activity type is not valid.");
    }

    $instructors = $this->instructorRepository->findBy(['id' => $newActivity->instructorIds]);
    if (count($instructors) < $activityType->getRequiredInstructors()) {
        throw new HttpException(Response::HTTP_BAD_REQUEST, "Not enough instructors for this activity.");
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



    // METODOS HARDCODED DE PRUEBA
    private function createHardcodedActivity(): ActivityNewDTO
    {
        return new ActivityNewDTO(
            date: new DateTime('2025-01-01'),
            duration: 90,
            activityTypeId: 1,
            instructorIds: [1]
        );
    }

    private function createForEdit(): ActivityNewDTO
    {
        return new ActivityNewDTO(
            date: new DateTime('2025-03-01'),
            duration: 90,
            activityTypeId: 2,
            instructorIds: [1, 2]
        );
    }

    public function addHardcodedActivity(): ActivityDTO
    {
        $hardcodedActivity = $this->createHardcodedActivity();
        return $this->addActivity($hardcodedActivity);
    }

    public function editHardcodedActivity(): ActivityDTO{
        $activityNew = $this->createForEdit();
       return $this->editActivity(4, $activityNew);
    }

    public function deleteActivityHardcoded(): bool
    {
        $activity = $this->activityRepository->find(3);
        if (!$activity) {
            return false;
        }
        /*foreach ($activity->getActivityInstructors() as $ai) {
            $this->entityManager->remove($ai);
        }
        $this->entityManager->remove($activity);
        $this->entityManager->flush();
        return true;
    }
    */
}
