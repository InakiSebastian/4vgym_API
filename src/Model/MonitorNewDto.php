<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class MonitorNewDto{
    
  
    public function __construct(
        #[Assert\NotBlank(message:"El nombre no puede estar vacío")]
        public string $name, 
        #[Assert\NotBlank(message:"Email no puede estar vacío")]
        public string $email, 
        #[Assert\NotBlank(message:"Telefono no puede estar vacío")]
        public string $phone, 
        #[Assert\NotBlank(message:"Photo no puede estar vacío")]
        public string $photo
        )
    {
        
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    

    

}

?>