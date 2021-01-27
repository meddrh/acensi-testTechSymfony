<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @SWG\Property(description="The unique identifier of the student.")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @SWG\Property(type="string", maxLength=25)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=25)
     * @SWG\Property(type="string", maxLength=25)
     */
    private $LastName;

    /**
     * @ORM\Column(type="integer", length=10)
     * @SWG\Property(type="integer", maxLength=10)
     */
    private $NumEtud;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="students")
     * @ORM\JoinColumn(nullable=true)
     * @SWG\Property(ref=@Model(type=Department::class))
     */
    private $department;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getNumEtud(): ?int
    {
        return $this->NumEtud;
    }

    public function setNumEtud(int $NumEtud): self
    {
        $this->NumEtud = $NumEtud;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }
}
