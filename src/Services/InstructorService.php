<?php

namespace App\Services;
use App\Entity\Instructor;
use App\Model\InstructorDTO;
use App\Repository\InstructorRepository;
use Doctrine\ORM\EntityManagerInterface;


class InstructorService
{
 
    public function __construct(private EntityManagerInterface $entityManager, private InstructorRepository $instructorRepository)
    {

    }


    public function getAllInstructors(): array
    {
        $allInstructors = $this->instructorRepository->findAll();

        return array_map(fn($instructor) => new InstructorDTO(
            id: $instructor->getId(),
            name: $instructor->getName(),
            mail: $instructor->getEmail(),
            phone: $instructor->getTelf()
        ), $allInstructors);

    }

    public function createInstructor(Instructor $instructor)
    {
        $this->entityManager->persist($instructor);
        $this->entityManager->flush();

        return $instructor;
    }

 
}
