<?php

namespace App\Model;


class InstructorDTO
{
    public function __construct(

        public int $id,
        public string $name,
        public string $mail,
        public int $phone,
        public ?string $photo = null){}
       
}