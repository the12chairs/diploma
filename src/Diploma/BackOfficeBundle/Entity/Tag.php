<?php

namespace Diploma\BackOfficeBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Diploma\BackOfficeBundle\Entity\Post;
/**
 * Tag
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tag
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
     * @ORM\Column(name="title", type="string")
     **/
    protected $title;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     */
    protected $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getPosts()
    {
        return $this->posts;
    }
}
