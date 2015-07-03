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
abstract class AbstractProduct implements ProductInterface
{
    /*
     * @var int
     */
    protected $id;
    
    /*
     * @var string
     */
    protected $sku;
    
    /*
     * @var string
     */
    protected $slug;
    
    /*
     * @var string
     */
    protected $name;
    
    /*
     * @var string
     */
    protected $description;
    
    /*
     * @var string
     */
    protected $shortDescription;
    
    /*
     * @var string
     */
    protected $url;
    
    /*
     * @var float
     */
    protected $price;
    
    /*
     * @var float
     */
    protected $retailPrice;
    
    /*
     * @var int
     */
    protected $qty;
    
    /*
     * @var float
     */
    protected $width;
    
    /*
     * @var float
     */
    protected $height;
    
    /*
     * @var float
     */
    protected $depth;
    
    /*
     * @var ManufacturerInterface
     */
    protected $manufacturer;
    
    /*
     * @var \DateTime
     */
    protected $availableOn;
    
    /*
     * @var string
     */
    protected $image;
    
    /*
     * @var string
     */
    protected $imageLabel;
    
    /*
     * @var \DateTime
     */
    protected $createdAt;
    
    /*
     * @var \DateTime
     */
    protected $updatedAt;
    
    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @inheritDoc
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getSku()
    {
        return $this->sku;
    }
    
    /**
     * @inheritDoc
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @inheritDoc
     */
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * @inheritDoc
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }
    
    /**
     * @inheritDoc
     */
    public function setUrl($url)
    {
        $this->url = $url;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    /**
     * @inheritDoc
     */
    public function setPrice($price)
    {
        $this->price = $price;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * @inheritDoc
     */
    public function setRetailPrice($retailPrice)
    {
        $this->retailPrice = $retailPrice;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getRetailPrice()
    {
        return $this->retailPrice;
    }
    
    /**
     * @inheritDoc
     */
    public function setQty($qty)
    {
        $this->qty = $qty;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getQty()
    {
        return $this->qty;
    }
    
    /**
     * @inheritDoc
     */
    public function setWidth($width)
    {
        $this->width = $width;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getWidth()
    {
        return $this->width;
    }
    
    /**
     * @inheritDoc
     */
    public function setHeight($height)
    {
        $this->height = $height;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getHeight()
    {
        return $this->height;
    }
    
    /**
     * @inheritDoc
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getDepth()
    {
        return $this->depth;
    }
    
    /**
     * @inheritDoc
     */
    public function setManufacturer(ManufacturerInterface $manufacturer)
    {
        $this->manufacturer = $manufacturer;
        
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }
    
    /**
     * @inheritDoc
     */
    public function setAvailableOn(\DateTime $availableOn = null)
    {
        $this->availableOn = $availableOn;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getAvailableOn()
    {
        return $this->availableOn;
    }
    
    /**
     * @inheritDoc
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
    
    /**
     * @inheritDoc
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * @inheritDoc
     */
    public function setImageLabel($imageLabel)
    {
        $this->imageLabel = $imageLabel;
    }
    
    /**
     * @inheritDoc
     */
    public function getImageLabel()
    {
        return $this->imageLabel;
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
        
        return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * @inheritDoc
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
        
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
