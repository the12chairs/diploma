<?php

namespace Diploma\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestResult
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TestResult
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @var
    * @ORM\ManyToOne(targetEntity="User", inversedBy="user")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    protected $user;

    /**
    * @var
    * @ORM\ManyToOne(targetEntity="Test", inversedBy="test")
    * @ORM\JoinColumn(name="test_id", referencedColumnName="id")
    */
    protected $test;

    /**
    * @var
    * @ORM\Column(name="points", type="integer")
    */
    protected $points;


    public function __construct()
    {
        $this->points = 0;
    }

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
     * Set points
     *
     * @param integer $points
     * @return TestResult
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set user
     *
     * @param \Diploma\BackOfficeBundle\Entity\User $user
     * @return TestResult
     */
    public function setUser(\Diploma\BackOfficeBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Diploma\BackOfficeBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set test
     *
     * @param \Diploma\BackOfficeBundle\Entity\Test $test
     * @return TestResult
     */
    public function setTest(\Diploma\BackOfficeBundle\Entity\Test $test = null)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return \Diploma\BackOfficeBundle\Entity\Test 
     */
    public function getTest()
    {
        return $this->test;
    }
}
