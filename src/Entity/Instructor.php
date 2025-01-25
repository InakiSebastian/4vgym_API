<?php

namespace App\Entity;

use App\Repository\InstructorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstructorRepository::class)]
class Instructor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $telf = null;

    /**
     * @var Collection<int, ActivityInstructor>
     */
    #[ORM\OneToMany(targetEntity: ActivityInstructor::class, mappedBy: 'instructor')]
    private Collection $activityInstructors;

    public function __construct()
    {
        $this->activityInstructors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelf(): ?int
    {
        return $this->telf;
    }

    public function setTelf(int $telf): static
    {
        $this->telf = $telf;

        return $this;
    }

    /**
     * @return Collection<int, ActivityInstructor>
     */
    public function getActivityInstructors(): Collection
    {
        return $this->activityInstructors;
    }

    public function addActivityInstructor(ActivityInstructor $activityInstructor): static
    {
        if (!$this->activityInstructors->contains($activityInstructor)) {
            $this->activityInstructors->add($activityInstructor);
            $activityInstructor->setInstructor($this);
        }

        return $this;
    }

    public function removeActivityInstructor(ActivityInstructor $activityInstructor): static
    {
        if ($this->activityInstructors->removeElement($activityInstructor)) {
            // set the owning side to null (unless already changed)
            if ($activityInstructor->getInstructor() === $this) {
                $activityInstructor->setInstructor(null);
            }
        }

        return $this;
    }
}
