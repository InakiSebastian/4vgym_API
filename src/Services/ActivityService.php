<?php

namespace App\Services;

use App\Entity\Activity;
use App\Entity\Monitor;
use App\Entity\ActivityType;
use App\Model\ActivityDTO;
use App\Model\ActivityNewDTO;
use App\Model\ActivityTypeDTO;
use App\Model\MonitorDTO;
use App\Repository\ActivityRepository;
use App\Repository\ActivityTypeRepository;
use App\Repository\MonitorRepository;
use Doctrine\ORM\EntityManagerInterface;

class ActivityService
{
    public function __construct(
        private ActivityRepository $activityRepo,
        private ActivityTypeRepository $typeRepo,
        private MonitorRepository $monitorRepo,
        private EntityManagerInterface $em
    ) {}

    public function findActivities(\DateTimeInterface $date = null): array
    {
        if ($date) {
            $activities = $this->activityRepo->findByDate($date);
        } else {
            $activities = $this->activityRepo->findAll();
        }
        return array_map(fn(Activity $a) => $this->toDTO($a), $activities);
    }

    public function addActivity(ActivityNewDTO $dto): ActivityDTO
{
    $start = new \DateTime($dto->date_start);
    $end   = new \DateTime($dto->date_end);

    $startTime = $start->format('H:i');
    $allowedTimes = ['09:00', '13:30', '17:30'];
    if (!in_array($startTime, $allowedTimes)) {
        throw new \Exception("Invalid start time. Allowed times: 09:00, 13:30, 17:30");
    }

    $interval = $end->diff($start);
    $durationInMinutes = $interval->h * 60 + $interval->i;
    if ($durationInMinutes !== 90) {
        throw new \Exception("Invalid duration. Must be exactly 90 minutes.");
    }

    $type = $this->typeRepo->find($dto->activity_type_id);
    if (!$type) {
        throw new \Exception("ActivityType not found");
    }

    $monitors = $this->monitorRepo->findBy(['id' => $dto->monitors_id]);
    if (count($monitors) < 1) {
        throw new \Exception("No monitors found with given IDs");
    }

    $activity = new Activity();
    $activity->setActivityType($type);
    $activity->setDateStart($start);
    $activity->setDateEnd($end);
    foreach ($monitors as $m) {
        $activity->addMonitor($m);
    }

    $this->em->persist($activity);
    $this->em->flush();
    return $this->toDTO($activity);
}

public function updateActivity(int $id, ActivityNewDTO $dto): ?ActivityDTO
{
    $activity = $this->activityRepo->find($id);
    if (!$activity) {
        return null;
    }

    $type = $this->typeRepo->find($dto->activity_type_id);
    if (!$type) {
        throw new \Exception("ActivityType not found");
    }

    $start = new \DateTime($dto->date_start);
    $end   = new \DateTime($dto->date_end);
    $activity->setActivityType($type);
    $activity->setDateStart($start);
    $activity->setDateEnd($end);

    foreach ($activity->getMonitors() as $oldMon) {
        $activity->removeMonitor($oldMon);
    }
    $monitors = $this->monitorRepo->findBy(['id' => $dto->monitors_id]);
    foreach ($monitors as $m) {
        $activity->addMonitor($m);
    }

    $this->em->flush();
    return $this->toDTO($activity);
}


    public function deleteActivity(int $id): bool
    {
        $activity = $this->activityRepo->find($id);
        if (!$activity) {
            return false;
        }

        $this->em->remove($activity);
        $this->em->flush();
        return true;
    }

    private function toDTO(Activity $a): ActivityDTO
    {
        $monDTOS = array_map(fn(Monitor $m) => new MonitorDTO(
            $m->getId(),
            $m->getName(),
            $m->getEmail(),
            $m->getPhone(),
            $m->getPhoto()
        ), $a->getMonitors()->toArray());

        $type = $a->getActivityType();
        $typeDTO = new ActivityTypeDTO(
            $type->getId(),
            $type->getName(),
            $type->getNumberMonitors()
        );

        return new ActivityDTO(
            $a->getId(),
            $typeDTO,
            $monDTOS,
            $a->getDateStart(),
            $a->getDateEnd()
        );
    }
}
