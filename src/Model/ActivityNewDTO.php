<?php

namespace App\Model;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class ActivityNewDTO
{
    public function __construct(
        public ?int $id,
        #[Assert\NotBlank] 
        public int $activity_type_id,

        #[Assert\Count(min: 1)]
        public array $monitors_id,

        #[Assert\NotBlank]
        #[Assert\Type("string")]
        public string $date_start,

        #[Assert\NotBlank]
        #[Assert\Type("string")]
        public string $date_end
    ) {}
}
