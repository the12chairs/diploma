<?php

namespace Diploma\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="posts")
     **/
    protected $posts;


    /**
    * @ORM\OneToMany(targetEntity="TestResult", mappedBy="results")
    **/
    protected $results;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        parent::__construct();
    }



    /**
     * Add posts
     *
     * @param \Diploma\BackOfficeBundle\Entity\Post $posts
     * @return User
     */
    public function addPost(\Diploma\BackOfficeBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \Diploma\BackOfficeBundle\Entity\Post $posts
     */
    public function removePost(\Diploma\BackOfficeBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add results
     *
     * @param \Diploma\BackOfficeBundle\Entity\TestResult $results
     * @return User
     */
    public function addResult(\Diploma\BackOfficeBundle\Entity\TestResult $results)
    {
        $this->results[] = $results;

        return $this;
    }

    /**
     * Remove results
     *
     * @param \Diploma\BackOfficeBundle\Entity\TestResult $results
     */
    public function removeResult(\Diploma\BackOfficeBundle\Entity\TestResult $results)
    {
        $this->results->removeElement($results);
    }

    /**
     * Get results
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResults()
    {
        return $this->results;
    }
}
