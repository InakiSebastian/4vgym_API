<?php

namespace App\Services;

use App\Entity\ActivityType;
use App\Model\ActivityTypeDTO;
use App\Repository\ActivityTypeRepository;

class ActivityTypeService
{
    public function __construct(private ActivityTypeRepository $repo) {}

    /**
     * Devuelve array de ActivityTypeDTO
     */
    public function findAll(): array
    {
        $types = $this->repo->findAll();
        return array_map(fn(ActivityType $t) => $this->toDTO($t), $types);
    }

    private function toDTO(ActivityType $entity): ActivityTypeDTO
    {
        return new ActivityTypeDTO(
            $entity->getId(),
            $entity->getName(),
            $entity->getNumberMonitors()
        );
    }
}
