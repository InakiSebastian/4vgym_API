<?php

namespace App\Model;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class ActivityNewDTO
{
    public function __construct(
        public ?int $id,

        #[Assert\NotBlank(message: "The activity type ID is required.")]
        public int $activity_type_id,

        #[Assert\Count(min: 1, minMessage: "At least one monitor is required.")]
        public array $monitors_id,

        #[Assert\NotBlank(message: "The start date is required.")]
        #[Assert\Type(type: "string", message: "The start date must be a valid string.")]
        public string $date_start,

        #[Assert\NotBlank(message: "The end date is required.")]
        #[Assert\Type(type: "string", message: "The end date must be a valid string.")]
        public string $date_end
    ) {}
}
