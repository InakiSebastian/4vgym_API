<?php

namespace App\Model;

use DateTime;

class ActivityDTO
{
    public function __construct(
        public int $id,
        public ActivityTypeDTO $activity_type,
        public array $monitors,
        public DateTime $date_start,
        public DateTime $date_end
    ) {}
}
