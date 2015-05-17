<?php

namespace Diploma\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Diploma\BackOfficeBundle\Entity\Tag;
/**
 * Post
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Post
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
     * @var
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts", cascade={"all"})
     * @ORM\JoinColumn(name="autor_id", referencedColumnName="id")
     */
    protected $autor;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=100)
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(name="post_text", type="text")
     */
    protected $postText;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="posts")
     * @ORM\JoinTable(name="posts_tags")
     **/
    protected $tags;

    /**
    * @ORM\Column(name="created_at", type="datetime")
    */
    protected $createdAt;

    /**
    * @ORM\OneToMany(targetEntity="Test", mappedBy="post")
    **/
    protected $tests;

    /**
     * @ORM\OneToMany(targetEntity="Script", mappedBy="post")
     **/
    protected $scripts;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }


    public function getId()
    {
        return $this->id;
    }

    public function setAutor(User $autor)
    {
        $this->autor = $autor;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setPostText($text)
    {
        $this->postText = $text;
    }

    public function getPostText()
    {
        return$this->postText;
    }

    public function getTags()
    {
        $this->tags = $this->tags ?: new ArrayCollection();

        return $this->tags;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * Add tags
     *
     * @param \Diploma\BackOfficeBundle\Entity\Tag $tags
     * @return Post
     */
    public function addTag(\Diploma\BackOfficeBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Diploma\BackOfficeBundle\Entity\Tag $tags
     */
    public function removeTag(\Diploma\BackOfficeBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Add tests
     *
     * @param \Diploma\BackOfficeBundle\Entity\Test $tests
     * @return Post
     */
    public function addTest(\Diploma\BackOfficeBundle\Entity\Test $tests)
    {
        $this->tests[] = $tests;

        return $this;
    }

    /**
     * Remove tests
     *
     * @param \Diploma\BackOfficeBundle\Entity\Test $tests
     */
    public function removeTest(\Diploma\BackOfficeBundle\Entity\Test $tests)
    {
        $this->tests->removeElement($tests);
    }

    /**
     * Get tests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTests()
    {
        return $this->tests;
    }

    /**
     * Add scripts
     *
     * @param \Diploma\BackOfficeBundle\Entity\Script $scripts
     * @return Post
     */
    public function addScript(\Diploma\BackOfficeBundle\Entity\Script $scripts)
    {
        $this->scripts[] = $scripts;

        return $this;
    }

    /**
     * Remove scripts
     *
     * @param \Diploma\BackOfficeBundle\Entity\Script $scripts
     */
    public function removeScript(\Diploma\BackOfficeBundle\Entity\Script $scripts)
    {
        $this->scripts->removeElement($scripts);
    }

    /**
     * Get scripts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getScripts()
    {
        return $this->scripts;
    }
}
