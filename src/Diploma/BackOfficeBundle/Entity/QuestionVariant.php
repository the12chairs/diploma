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
    * @ORM\ManyToOne(targetEntity="Question", inversedBy="variants")
    * @ORM\JoinColumn(name="variant_id", referencedColumnName="id")
    */
    protected $question;

    /**
    * @var string
    * @ORM\Column(name="variant_text", type="string", length=100)
    */
    private $variantText;


    /**
     * @ORM\Column(name="is_right", type="boolean")
     */
    protected $right;

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

    public function isRight()
    {
        return $this->right;
    }

    public function setIsRight($right)
    {
        $this->right = $right;
    }

    /**
     * Set right
     *
     * @param boolean $right
     * @return QuestionVariant
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
