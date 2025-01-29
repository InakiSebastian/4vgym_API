<?php

namespace App\Model;


class ActivityTypeDTO
{

     public function __construct(
        public int $id,
        public string $name,
        public int $numberMonitors,
        public ?string $icon = null
    ) {
    }
       
    // TODO Manejar diferentes fuentes de iconos: PARA ANGULAR
        public function getIcon(): string{
            return ($this->icon != null)? $this->icon : "icon.png";
        }
}

