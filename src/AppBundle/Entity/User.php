<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="Institut", type="string", length=255,nullable=true)
     */
    private $institut;

    /**
     * @var string
     *
     * @ORM\Column(name="Entreprise", type="string", length=255,nullable=true)
     */
    private $entreprise;


    /**
     * @var string
     * @Assert\NotBlank(message=" please enter an image")
     * @Assert\Image()
     * @ORM\Column (name="image", type="string",length=255,nullable=true)
     */

    private $image;


    /**
     * @var string
     *
     * @ORM\Column(name="headline", type="string", length=255,nullable=true)
     */

     private $headline;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255,nullable=true)
     */

     private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text",nullable=true)
     */
    private $notes;


    /**
     * @var string
     *
     * @ORM\Column(name="field", type="string", length=255,nullable=true)
     */

    private $field;



    /**
     * @ORM\ManyToMany(targetEntity="skill", inversedBy="users",cascade={"persist"})
     * @ORM\JoinTable(name="userskils")
     */

    private $skills;

    /**
     *@ORM\OneToMany(targetEntity="internship", mappedBy="user", cascade={"remove"})
     */
    private $internships;

    /**
     * @ORM\ManyToMany(targetEntity="internship", inversedBy="users",cascade={"persist"})
     * @ORM\JoinTable(name="AppliedInternships")
     */
    private $AppliedInternship;

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
     * Set institut
     *
     * @param string $institut
     *
     * @return User
     */
    public function setInstitut($institut)
    {
        $this->institut = $institut;

        return $this;
    }

    /**
     * Get institut
     *
     * @return string
     */
    public function getInstitut()
    {
        return $this->institut;
    }

    /**
     * Set entreprise
     *
     * @param string $entreprise
     *
     * @return User
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;

        return $this;
    }



    /**
     * Get entreprise
     *
     * @return string
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }



    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Set headline
     *
     * @param string $headline
     *
     * @return User
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return User
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return User
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set field
     *
     * @param string $field
     *
     * @return User
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Add skill
     *
     * @param \AppBundle\Entity\skill $skill
     *
     * @return User
     */
    public function addSkill(\AppBundle\Entity\skill $skill)
    {
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \AppBundle\Entity\skill $skill
     */
    public function removeSkill(\AppBundle\Entity\skill $skill)
    {
        $this->skills->removeElement($skill);
    }

    /**
     * Get skills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Add internship
     *
     * @param \AppBundle\Entity\internship $internship
     *
     * @return User
     */
    public function addInternship(\AppBundle\Entity\internship $internship)
    {
        $this->internships[] = $internship;

        return $this;
    }

    /**
     * Remove internship
     *
     * @param \AppBundle\Entity\internship $internship
     */
    public function removeInternship(\AppBundle\Entity\internship $internship)
    {
        $this->internships->removeElement($internship);
    }

    /**
     * Get internships
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInternships()
    {
        return $this->internships;
    }




    /**
     * Add appliedInternship
     *
     * @param \AppBundle\Entity\internship $appliedInternship
     *
     * @return User
     */
    public function addAppliedInternship(\AppBundle\Entity\internship $appliedInternship)
    {
        $this->AppliedInternship[] = $appliedInternship;

        return $this;
    }

    /**
     * Remove appliedInternship
     *
     * @param \AppBundle\Entity\internship $appliedInternship
     */
    public function removeAppliedInternship(\AppBundle\Entity\internship $appliedInternship)
    {
        $this->AppliedInternship->removeElement($appliedInternship);
    }

    /**
     * Get appliedInternship
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAppliedInternship()
    {
        return $this->AppliedInternship;
    }
}
