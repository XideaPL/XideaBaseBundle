<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Product\Model;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ProductInterface
{
    /**
     * Returns the id.
     * 
     * @return string The id
     */
    function getId();
    
    /**
     * Sets the sku.
     *
     * @param string $sku
     */
    function setSku($sku);
    
    /**
     * Returns the sku.
     *
     * @return string
     */
    function getSku();
    
    /**
     * Sets the slug.
     *
     * @param string $slug
     */
    function setSlug($slug);
    
    /**
     * Returns the slug.
     *
     * @return string
     */
    function getSlug();

    /**
     * Sets the name.
     *
     * @param string $name
     */
    function setName($name);
    
    /**
     * Returns the name.
     *
     * @return string
     */
    function getName();

    /**
     * Sets the description.
     *
     * @param string $description
     */
    function setDescription($description);
    
    /**
     * Returns the description.
     *
     * @return string
     */
    function getDescription();
    
    /**
     * Sets the short description.
     *
     * @param string $shortDescription
     */
    function setShortDescription($shortDescription);
    
    /**
     * Returns the short description.
     *
     * @return string
     */
    function getShortDescription();
    
    /**
     * Sets the url.
     *
     * @param string $url
     */
    function setUrl($url);
    
    /**
     * Returns the url.
     *
     * @return string
     */
    function getUrl();
    
    /**
     * Sets the price.
     *
     * @param float $price
     */
    function setPrice($price);
    
    /**
     * Returns the price.
     *
     * @return float
     */
    function getPrice();
    
    /**
     * Sets the retailPrice.
     *
     * @param float $retailPrice
     */
    function setRetailPrice($retailPrice);
    
    /**
     * Returns the retailPrice.
     *
     * @return float
     */
    function getRetailPrice();
    
    /**
     * Sets the qty.
     *
     * @param int $qty
     */
    function setQty($qty);
    
    /**
     * Returns the qty.
     *
     * @return int
     */
    function getQty();
    
    /**
     * Sets the width.
     *
     * @param float $width
     */
    function setWidth($width);
    
    /**
     * Returns the width.
     *
     * @return float
     */
    function getWidth();
    
    /**
     * Sets the height.
     *
     * @param float $height
     */
    function setHeight($height);
    
    /**
     * Returns the height.
     *
     * @return float
     */
    function getHeight();
    
    /**
     * Sets the depth.
     *
     * @param float $depth
     */
    function setDepth($depth);
    
    /**
     * Returns the depth.
     *
     * @return float
     */
    function getDepth();
    
    /**
     * Sets the manufacturer.
     * 
     * @param ManufacturerInterface $manufacturer
     */
    function setManufacturer(ManufacturerInterface $manufacturer);

    /**
     * Returns the manufacturer.
     *
     * @return ManufacturerInterface
     */
    function getManufacturer();

    /**
     * @param \DateTime $availableOn
     */
    function setAvailableOn(\DateTime $availableOn = null);

    /**
     * @return \DateTime
     */
    function getAvailableOn();
    
    /**
     * Sets the image.
     *
     * @param float $image
     */
    function setImage($image);
    
    /**
     * Returns the image.
     *
     * @return float
     */
    function getImage();
    
    /**
     * Sets the image label.
     *
     * @param float $imageLabel
     */
    function setImageLabel($imageLabel);
    
    /**
     * Returns the image label.
     *
     * @return float
     */
    function getImageLabel();
    
    /**
     * @param \DateTime $createdAt
     */
    function setCreatedAt(\DateTime $createdAt = null);

    /**
     * @return \DateTime
     */
    function getCreatedAt();

    /**
     * @param \DateTime $updatedAt
     */
    function setUpdatedAt(\DateTime $updatedAt = null);

    /**
     * @return \DateTime
     */
    function getUpdatedAt();
}
