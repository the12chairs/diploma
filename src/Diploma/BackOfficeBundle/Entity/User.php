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
     * @var string
     * @ORM\Column(name="firstname", type="string", length=100)
     */
    protected $firstname;
    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=100)
     */
    protected $lastname;

    /**
     * @var string
     * @ORM\Column(name="grouppa", type="string", length=100)
     */
    protected $grouppa;
    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="user")
     **/
    protected $tasks;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user", cascade={"all"})
     **/
    protected $posts;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="user", cascade={"all"})
     **/
    protected $formMessages;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="user", cascade={"all"})
     **/
    protected $toMessages;
    
    /**
    * @ORM\OneToMany(targetEntity="TestResult", mappedBy="user", cascade={"all"})
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

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return true;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return true;
    }

    /**
     * Add tasks
     *
     * @param \Diploma\BackOfficeBundle\Entity\Task $tasks
     * @return User
     */
    public function addTask(\Diploma\BackOfficeBundle\Entity\Task $tasks)
    {
        $this->tasks[] = $tasks;

        return $this;
    }

    /**
     * Remove tasks
     *
     * @param \Diploma\BackOfficeBundle\Entity\Task $tasks
     */
    public function removeTask(\Diploma\BackOfficeBundle\Entity\Task $tasks)
    {
        $this->tasks->removeElement($tasks);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Add formMessages
     *
     * @param \Diploma\BackOfficeBundle\Entity\Message $formMessages
     * @return User
     */
    public function addFormMessage(\Diploma\BackOfficeBundle\Entity\Message $formMessages)
    {
        $this->formMessages[] = $formMessages;

        return $this;
    }

    /**
     * Remove formMessages
     *
     * @param \Diploma\BackOfficeBundle\Entity\Message $formMessages
     */
    public function removeFormMessage(\Diploma\BackOfficeBundle\Entity\Message $formMessages)
    {
        $this->formMessages->removeElement($formMessages);
    }

    /**
     * Get formMessages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFormMessages()
    {
        return $this->formMessages;
    }

    /**
     * Add toMessages
     *
     * @param \Diploma\BackOfficeBundle\Entity\Message $toMessages
     * @return User
     */
    public function addToMessage(\Diploma\BackOfficeBundle\Entity\Message $toMessages)
    {
        $this->toMessages[] = $toMessages;

        return $this;
    }

    /**
     * Remove toMessages
     *
     * @param \Diploma\BackOfficeBundle\Entity\Message $toMessages
     */
    public function removeToMessage(\Diploma\BackOfficeBundle\Entity\Message $toMessages)
    {
        $this->toMessages->removeElement($toMessages);
    }

    /**
     * Get toMessages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getToMessages()
    {
        return $this->toMessages;
    }

    /**
     * Set group
     *
     * @param string $group
     * @return User
     */
    public function setGrouppa($grouppa)
    {
        $this->grouppa = $grouppa;

        return $this;
    }

    /**
     * Get group
     *
     * @return string 
     */
    public function getGrouppa()
    {
        return $this->grouppa;
    }
}
