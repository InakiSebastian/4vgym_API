<?php

namespace App\Model;


class ActivityTypeDTO
{
    public function __construct(

        public int $id,
        public string $name,
        public int $instructorsNumber,
        public string $icon){}
       
}