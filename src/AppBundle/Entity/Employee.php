<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ApiResource
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployeeRepository")
 */
class Employee
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"admins"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=64)
     * @Assert\NotBlank(), message = "Veuillez indiquer un vrai prénom !"
     * @Groups({"users", "list"})
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=64)
     * @Assert\NotBlank(), message = "Veuillez indiquer un vrai nom !"
     * @Groups({"users", "list"})
     */
    private $lastname;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     * @Assert\NotBlank(), message = "Veuillez indiquer un vrai age !"
     * @Groups({"users", "details"})
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=255)
     * @Assert\NotBlank(), message = "Veuillez indiquer un vrai job !"
     * @Groups({"admins", "list", "details"})
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     * @Assert\NotBlank(), message = "Veuillez indiquer un vrai numéro de téléphone !"
     * @Groups({"admins", "list", "details"})
     */
    private $phone;

    /**
     * @var date
     *
     * @ORM\Column(name="dateDebut", type="date")
     * @Groups({"details"})
     */
    private $dateDebut;

    /**
     * @var date
     *
     * @ORM\Column(name="dateFin", type="date")
     * @Groups({"details"})
     */
    private $dateFin;

    /**
     * @ORM\OneToOne(targetEntity="Environment", cascade={"persist"})
     * @Assert\NotBlank(), message = "Veuillez indiquer une vrai localisation !"
     * @Groups({"details"})
     */
    private $environment;

    /**
     * @ORM\OneToMany(targetEntity="Skill", mappedBy="employee")
     * @Groups({"details"})
     */
    public $skills;


    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Employee
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Employee
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Employee
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set job
     *
     * @param string $job
     *
     * @return Employee
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Employee
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set environment
     * 
     * @param Environment $environment
     * 
     * @return Employee
     */
    public function setEnvironment(Environment $environment)
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * Get environment
     * 
     * @return environment
     */
    public function GetEnvironment()
    {
        return $this->environment;
    }

    /**
     * Add skill
     *
     * @param \AppBundle\Entity\Skills $skill
     *
     * @return Employee
     */
    public function addSkill(\AppBundle\Entity\Skill $skill)
    {
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \AppBundle\Entity\Skills $skill
     */
    public function removeSkill(\AppBundle\Entity\Skill $skill)
    {
        $this->skills->removeElement($skill);
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Employee
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Employee
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }
}
