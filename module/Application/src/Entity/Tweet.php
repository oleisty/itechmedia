<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Tweet
{
    /**
     * @var int
     *
     * @ORM\Id
     */
    private $id;
    
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $idStr;
    
    /**
     * @var string
     */
    private $text;
    
    /**
     * @var string
     */
    private $image;
    
    /**
     * @var string
     */
    private $createdAt;

    public function getId()
    {
        return $this->id;
    }

    public function getIdStr()
    {
        return $this->idStr;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setIdStr($idStr)
    {
        $this->idStr = $idStr;
        return $this;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }
    
    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }
    
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
