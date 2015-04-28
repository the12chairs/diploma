<?php

namespace Diploma\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Test
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
    private $title;

    /**
    * @ORM\OneToMany(targetEntity="Question", mappedBy="test")
    **/
    protected $questions;

    /**
    * @ORM\OneToMany(targetEntity="TestResult", mappedBy="test")
    **/
    protected $results;

    /**
    * @var
    * @ORM\ManyToOne(targetEntity="Post", inversedBy="tests", cascade={"all"})
    * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
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
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->results = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Test
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
     * Add questions
     *
     * @param \Diploma\BackOfficeBundle\Entity\Question $questions
     * @return Test
     */
    public function addQuestion(\Diploma\BackOfficeBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \Diploma\BackOfficeBundle\Entity\Question $questions
     */
    public function removeQuestion(\Diploma\BackOfficeBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Add results
     *
     * @param \Diploma\BackOfficeBundle\Entity\TestResult $results
     * @return Test
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

    public function getMaxResult($user)
    {
        $resArray = array();
        foreach($this->results as $result) {
            if($result->getUser()->getUsername() == $user) {
                $resArray[] = $result->getPoints();
            }
        }
        if(empty($resArray)) {
            return 0;
        } else {
            return max($resArray);
        }
    }
    /**
     * Set post
     *
     * @param \Diploma\BackOfficeBundle\Entity\Post $post
     * @return Test
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
