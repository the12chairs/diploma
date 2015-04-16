<?php

namespace Diploma\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionVariant
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class QuestionVariant
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
    * @ORM\ManyToOne(targetEntity="Question", inversedBy="variants", cascade={"all"})
    * @ORM\JoinColumn(name="variant_id", referencedColumnName="id")
    */
    protected $question;


    /**
    * @var
    * @ORM\ManyToOne(targetEntity="Question", inversedBy="answers", cascade={"all"})
    * @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
    */
    protected $answer;


    /**
    * @var string
    * @ORM\Column(name="variant_text", type="string", length=100)
    */
    private $variantText;

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
     * Set variantText
     *
     * @param string $variantText
     * @return QuestionVariant
     */
    public function setVariantText($variantText)
    {
        $this->variantText = $variantText;

        return $this;
    }

    /**
     * Get variantText
     *
     * @return string 
     */
    public function getVariantText()
    {
        return $this->variantText;
    }

    /**
     * Set question
     *
     * @param \Diploma\BackOfficeBundle\Entity\Question $question
     * @return QuestionVariant
     */
    public function setQuestion(\Diploma\BackOfficeBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Diploma\BackOfficeBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param \Diploma\BackOfficeBundle\Entity\Question $answer
     * @return QuestionVariant
     */
    public function setAnswer(\Diploma\BackOfficeBundle\Entity\Question $answer = null)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return \Diploma\BackOfficeBundle\Entity\Question 
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
