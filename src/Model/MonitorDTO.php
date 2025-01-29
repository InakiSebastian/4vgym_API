<?php

namespace App\Model;


class MonitorDTO
{
    public function __construct(

        public ?int $id,
        public string $name,
        public string $email,
        public ?string $phone = null,
        public ?string $photo = null
    ){}
}