<?php

namespace Diploma\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Script
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Script
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
     * @ORM\Column(name="title", type="string", length=100)
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(name="code", type="text")
     */
    protected $code;
    /**
     * @var string
     * @ORM\Column(name="difficult", type="string")
     */
    protected $difficult;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="scripts")
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id")
     */
    protected $post;

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
     * @return Script
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
     * Set code
     *
     * @param string $code
     * @return Script
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set difficult
     *
     * @param string $difficult
     * @return Script
     */
    public function setDifficult($difficult)
    {
        $this->difficult = $difficult;

        return $this;
    }

    /**
     * Get difficult
     *
     * @return string 
     */
    public function getDifficult()
    {
        return $this->difficult;
    }

    /**
     * Set post
     *
     * @param \Diploma\BackOfficeBundle\Entity\Post $post
     * @return Script
     */
    public function setPost(\Diploma\BackOfficeBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \Diploma\BackOfficeBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }
}
