<?php

namespace App\Services;

use App\Repository\ActivityTypeRepository;
use App\Model\ActivityTypeDTO;

class ActivityTypeService
{
    /*
    public function __construct(private ActivityTypeRepository $activityTypeRepository) {}


    public function getAllActivityTypes(): array
    {
        $activityTypes = $this->activityTypeRepository->findAll();

        return array_map(fn($type) => new ActivityTypeDTO(
            id: $type->getId(),
            name: $type->getName(),
            instructorsNumber: $type->getRequiredInstructors(),
            icon: "icono.png"
        ), $activityTypes);
    }
        */
}