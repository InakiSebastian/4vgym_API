<?php

namespace App\Model;

use DateTime;

class ActivityDTO
{
    public function __construct(
        public int $id,
        public DateTime $date,
        public int $duration,
        public ActivityTypeDTO $activityType,
        public array $instructors
    ) {}
}
