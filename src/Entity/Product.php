<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="tblProductData")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */

class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="intProductDataId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $intProductDataId;

    /**
     * @var string
     *
     * @ORM\Column(name="strProductName", type="string", length=50)
     */
    private $strProductName;


    /**
     * @var string
     *
     * @ORM\Column(name="strProductDesc", type="string", length=255)
     */
    private $strProductDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="strProductCode", type="string", length=255)
     */
    private $strProductCode;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dtmAdded", type="datetime", nullable=true, options={"default":NULL})
     */
    private $dtmAdded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dtmDiscontinued", type="datetime", nullable=true, options={"default":NULL})
     */
    private $dtmDiscontinued;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="stmTimestamp", type="datetime")
     */
    private $stmTimestamp;


    /**
     * @var int
     *
     * @ORM\Column(name="stock_level", type="integer")
     */
    private $stockLevel;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


    /**
     * Get intProductDataId
     *
     * @return int
     */
    public function getId()
    {
        return $this->intProductDataId;
    }

    /**
     * Set Product Name
     *
     * @param string $strProductName
     *
     * @return Product
     */
    public function setProductName($strProductName)
    {
        $this->strProductName = $strProductName;

        return $this;
    }

    /**
     * Get Product Name
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->strProductName;
    }

    /**
     * Set Product Desc
     *
     * @param integer $strProductDesc
     *
     * @return Product
     */
    public function setProductDesc($strProductDesc)
    {
        $this->strProductDesc = $strProductDesc;

        return $this;
    }

    /**
     * Get Product Desc
     *
     * @return string
     */
    public function getProductDesc()
    {
        return $this->strProductDesc;
    }

    /**
     * Set Product Code
     *
     * @param string $strProductCode
     *
     * @return Product
     */
    public function setProductCode($strProductCode)
    {
        $this->strProductCode = $strProductCode;

        return $this;
    }

    /**
     * Get Product Code
     *
     * @return string
     */
    public function getProductCode()
    {
        return $this->strProductCode;
    }

    /**
     * Set Dtm Added
     *
     *
     * @return Product
     */
    public function setDtmAdded($dtmAdded)
    {
        $this->dtmAdded = $dtmAdded;

        return $this;
    }

    /**
     * Get Dtm Added
     *
     * @return string
     */
    public function getDtmAdded()
    {
        return $this->dtmAdded;
    }

    /**
     * Set Dtm Discontinued
     *
     * @param string $dtmDiscontinued
     *
     * @return Product
     */
    public function setDtmDiscontinued($dtmDiscontinued)
    {

        $this->dtmDiscontinued = $dtmDiscontinued;

        return $this;
    }

    /**
     * Get Dtm Discontinued
     *
     * @return string
     */
    public function getDtmDiscontinued()
    {
        return $this->dtmDiscontinued;
    }

    /**
     * Set Stm Timestamp
     *
     *
     * @return string
     */
    public function setStmTimestamp($stmTimestamp)
    {
        $this->stmTimestamp = $stmTimestamp;

        return $this;
    }

    /**
     * Get Stm Timestamp
     *
     * @return string
     */
    public function getStmTimestamp()
    {
        return $this->stmTimestamp;
    }

    /**
     * Set Stock Level
     *
     * @param integer $stockLevel
     *
     * @return Product
     */
    public function setStockLevel($stockLevel)
    {
        $this->stockLevel = (int)$stockLevel;

        return $this;
    }

    /**
     * Get Stock Level
     *
     * @return integer
     */
    public function getStockLevel()
    {
        return $this->stockLevel;
    }

    /**
     * Set Price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = (float)$price;

        return $this;
    }

    /**
     * Get Price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}