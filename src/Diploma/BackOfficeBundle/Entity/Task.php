<?php

namespace Diploma\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Task
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tasks", cascade={"all"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var string
     * @ORM\Column(name="text", type="text")
     */
    protected $text;

    /**
     * @var string
     * @ORM\Column(name="answer", type="text", nullable=true)
     */
    protected $answer;

    /**
     * @var string
     * @ORM\Column(name="right_answer", type="text", nullable=true)
     */
    protected $rightAnswer;

    /**
     * @var string
     * @ORM\Column(name="is_seen", type="boolean")
     */
    protected $seen;

    /**
     * @var boolean
     * @ORM\Column(name="is_right", type="boolean")
     */
    protected $right;

    public function __construct()
    {
        $this->seen = false;
        $this->right = false;
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
     * Set text
     *
     * @param string $text
     * @return Task
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return Task
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set user
     *
     * @param \Diploma\BackOfficeBundle\Entity\User $user
     * @return Task
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
     * Set rightAnswer
     *
     * @param string $rightAnswer
     * @return Task
     */
    public function setRightAnswer($rightAnswer)
    {
        $this->rightAnswer = $rightAnswer;

        return $this;
    }

    /**
     * Get rightAnswer
     *
     * @return string 
     */
    public function getRightAnswer()
    {
        return $this->rightAnswer;
    }

    /**
     * Set seen
     *
     * @param boolean $seen
     * @return Task
     */
    public function setSeen($seen)
    {
        $this->seen = $seen;

        return $this;
    }

    /**
     * Get seen
     *
     * @return boolean 
     */
    public function isSeen()
    {
        return $this->seen;
    }

    /**
     * Get seen
     *
     * @return boolean 
     */
    public function getSeen()
    {
        return $this->seen;
    }

    /**
     * Set right
     *
     * @param boolean $right
     * @return Task
     */
    public function setRight($right)
    {
        $this->right = $right;

        return $this;
    }

    /**
     * Get right
     *
     * @return boolean 
     */
    public function getRight()
    {
        return $this->right;
    }
}
