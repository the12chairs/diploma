<?php

namespace Diploma\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Question
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
    * @ORM\ManyToOne(targetEntity="Test", inversedBy="questions", cascade={"all"})
    * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
    */
    protected $test;

    /**
    * @ORM\Column(name="question_text", type="string", length=500)
    */
    protected $questionText;

    /**
    * @ORM\OneToMany(targetEntity="QuestionVariant", mappedBy="variants")
    **/
    protected $variants;

    /**
    * @ORM\OneToMany(targetEntity="QuestionVariant", mappedBy="answers")
    **/
    protected $answers;

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
        $this->variants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set questionText
     *
     * @param string $questionText
     * @return Question
     */
    public function setQuestionText($questionText)
    {
        $this->questionText = $questionText;

        return $this;
    }

    /**
     * Get questionText
     *
     * @return string 
     */
    public function getQuestionText()
    {
        return $this->questionText;
    }

    /**
     * Set test
     *
     * @param \Diploma\BackOfficeBundle\Entity\Test $test
     * @return Question
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

    /**
     * Add variants
     *
     * @param \Diploma\BackOfficeBundle\Entity\QuestionVariant $variants
     * @return Question
     */
    public function addVariant(\Diploma\BackOfficeBundle\Entity\QuestionVariant $variants)
    {
        $this->variants[] = $variants;

        return $this;
    }

    /**
     * Remove variants
     *
     * @param \Diploma\BackOfficeBundle\Entity\QuestionVariant $variants
     */
    public function removeVariant(\Diploma\BackOfficeBundle\Entity\QuestionVariant $variants)
    {
        $this->variants->removeElement($variants);
    }

    /**
     * Get variants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * Add answers
     *
     * @param \Diploma\BackOfficeBundle\Entity\QuestionVariant $answers
     * @return Question
     */
    public function addAnswer(\Diploma\BackOfficeBundle\Entity\QuestionVariant $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \Diploma\BackOfficeBundle\Entity\QuestionVariant $answers
     */
    public function removeAnswer(\Diploma\BackOfficeBundle\Entity\QuestionVariant $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}
