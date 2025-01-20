<?php

namespace App\Services;
use App\Entity\Instructor;
use Doctrine\ORM\EntityManagerInterface;


class InstructorService
{
 
    public function __construct(private EntityManagerInterface $entityManager)
    {

    }


    public function getAllInstructors(): array
    {
        //DEVUELVE [{},{},{}]
        return $this->entityManager->getRepository(Instructor::class)->findAll();

    }

    public function createInstructor(Instructor $instructor): Instructor
    {
        $this->entityManager->persist($instructor);
        $this->entityManager->flush();

        return $instructor;
    }

 
}
