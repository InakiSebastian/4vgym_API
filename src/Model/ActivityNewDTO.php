<?php

namespace App\Model;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class ActivityNewDTO
{
    public function __construct(
        #[Assert\NotBlank]
        public DateTime $date,

        #[Assert\NotBlank]
        public int $duration,

        #[Assert\NotBlank(message: "The type is mandatory!")]
        public int $activityTypeId,

        #[Assert\Count(min: 1, minMessage: "At least one instructor is required!")]
        public array $instructorIds
    ) {}
}
