<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * internship
 *
 * @ORM\Table(name="internship")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\internshipRepository")
 */
class internship
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
     * @ORM\Column(name="title", type="string", length=255,nullable=true)
     */
    private $title;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date",nullable=true)
     */
    private $date;


    /**
     * @var string
     * @Assert\NotBlank(message=" please enter an image" )
     * @Assert\Image()
     * @ORM\Column (name="image", type="string",length=255,nullable=true)
     */

    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="userpicture", type="string", length=255,nullable=true)
     */
    private $userpicture;


    /**
     * @var string
     *
     * @ORM\Column(name="userlocation", type="string", length=255,nullable=true)
     */

    private $userlocation;



    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="internships")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     */
    private $description;


    /**
     * @var string
     *
     * @ORM\Column(name="entreprise_name", type="string", length=255,nullable=true)
     */

    private $entreprise_name;


    /**
     * @ORM\ManyToMany(targetEntity="User",mappedBy="AppliedInternship")
     */
    private $users;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return internship
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return internship
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return internship
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return internship
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return internship
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set entrepriseName
     *
     * @param string $entrepriseName
     *
     * @return internship
     */
    public function setEntrepriseName($entrepriseName)
    {
        $this->entreprise_name = $entrepriseName;

        return $this;
    }

    /**
     * Get entrepriseName
     *
     * @return string
     */
    public function getEntrepriseName()
    {
        return $this->entreprise_name;
    }




    /**
     * Set userpicture
     *
     * @param string $userpicture
     *
     * @return internship
     */
    public function setUserpicture($userpicture)
    {
        $this->userpicture = $userpicture;

        return $this;
    }

    /**
     * Get userpicture
     *
     * @return string
     */
    public function getUserpicture()
    {
        return $this->userpicture;
    }

    /**
     * Set userlocation
     *
     * @param string $userlocation
     *
     * @return internship
     */
    public function setUserlocation($userlocation)
    {
        $this->userlocation = $userlocation;

        return $this;
    }

    /**
     * Get userlocation
     *
     * @return string
     */
    public function getUserlocation()
    {
        return $this->userlocation;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return internship
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
