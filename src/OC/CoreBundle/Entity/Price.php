<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Price
 *
 * @ORM\Table(name="price")
 * @ORM\Entity(repositoryClass="OC\CoreBundle\Repository\PriceRepository")
 */
class Price
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=150)
     */
    protected $category;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=5, scale=2)
     * @Assert\Range(min=0)
     */
    protected $price;

    /**
     * @var string
     *
     * @ORM\Column(name="age_min", type="smallint", nullable=true)
     */
    protected $ageMin;

    /**
     * @var string
     *
     * @ORM\Column(name="age_max", type="smallint", nullable=true)
     */
    protected $ageMax;

    /**
     * @var string
     *
     * @ORM\Column(name="rule", type="string", length=255, nullable=true)
     */
    protected $rule;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Price
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Price
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getAgeMin()
    {
        return $this->ageMin;
    }

    /**
     * @param string $ageMin
     */
    public function setAgeMin($ageMin)
    {
        $this->ageMin = $ageMin;
    }

    /**
     * @return string
     */
    public function getAgeMax()
    {
        return $this->ageMax;
    }

    /**
     * @param string $ageMax
     */
    public function setAgeMax($ageMax)
    {
        $this->ageMax = $ageMax;
    }

    /**
     * @return string
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @param string $rule
     */
    public function setRule($rule)
    {
        $this->rule = $rule;
    }







}

