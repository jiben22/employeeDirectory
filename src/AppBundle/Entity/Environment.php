<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Environment
 *
 * @ORM\Table(name="environment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EnvironmentRepository")
 */
class Environment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="building", type="string", length=255)
     * @Groups({"details"})
     */
    private $building;

    /**
     * @var int
     *
     * @ORM\Column(name="postal_code", type="integer")
     * @Groups({"details"})
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="deskroom", type="string", length=255)
     * @Groups({"details"})
     */
    private $deskroom;


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
     * Set building
     *
     * @param string $building
     *
     * @return Environment
     */
    public function setBuilding($building)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get building
     *
     * @return string
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set postalCode
     *
     * @param integer $postalCode
     *
     * @return Environment
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return int
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set deskroom
     *
     * @param string $deskroom
     *
     * @return Environment
     */
    public function setDeskroom($deskroom)
    {
        $this->deskroom = $deskroom;

        return $this;
    }

    /**
     * Get deskroom
     *
     * @return string
     */
    public function getDeskroom()
    {
        return $this->deskroom;
    }
}
