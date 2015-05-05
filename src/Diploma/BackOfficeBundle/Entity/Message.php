<?php

namespace Diploma\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Message
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Message
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
     * @var string
     * @ORM\Column(name="post_text", type="text")
     */
    protected $message;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="User", inversedBy="messages", cascade={"all"})
     * @ORM\JoinColumn(name="from_id", referencedColumnName="id")
     */
    protected $from;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="User", inversedBy="messages", cascade={"all"})
     * @ORM\JoinColumn(name="to_id", referencedColumnName="id")
     */
    protected $to;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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
     * Set message
     *
     * @param string $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Message
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set from
     *
     * @param \Diploma\BackOfficeBundle\Entity\User $from
     * @return Message
     */
    public function setFrom(\Diploma\BackOfficeBundle\Entity\User $from = null)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return \Diploma\BackOfficeBundle\Entity\User 
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to
     *
     * @param \Diploma\BackOfficeBundle\Entity\User $to
     * @return Message
     */
    public function setTo(\Diploma\BackOfficeBundle\Entity\User $to = null)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return \Diploma\BackOfficeBundle\Entity\User 
     */
    public function getTo()
    {
        return $this->to;
    }
}
