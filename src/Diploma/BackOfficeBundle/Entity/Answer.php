<?php

namespace Diploma\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Answer
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
    * @ORM\ManyToOne(targetEntity="Question", inversedBy="answers", cascade={"all"})
    * @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
    */
    protected $question;


    /**
    * @var string
    * @ORM\Column(name="variant_text", type="string", length=100)
    */
    private $answerText;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
