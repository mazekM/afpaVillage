<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class EvenementsSearch {

    
    /**
     * @var int|null
     */
    private $maxId;

    /**
     * @var int|null
     * @Assert\Range(min=1, max=100)
     */
    private $minId;
        
    /**
     * @var integer|null
     */
    private $distance;

     /**
     * @var float|null
     */
    private $lat; 

    /**
     * @var float|null
     */
    private $lng;
        
    /**
     * Get the value of maxId
     *
     * @return  int|null
     */ 
    public function getMaxId()
    {
        return $this->maxId;
    }

    /**
     * Set the value of maxId
     *
     * @param  int|null  $maxId
     *
     * @return  self
     */ 
    public function setMaxId(int $maxId)
    {
        $this->maxId = $maxId;

        return $this;
    }

    /**
     * Get the value of minId
     *
     * @return  int|null
     */ 
    public function getMinId()
    {
        return $this->minId;
    }

    /**
     * Set the value of minId
     *
     * @param  int|null  $minId
     *
     * @return  self
     */ 
    public function setMinId(int $minId)
    {
        $this->minId = $minId;

        return $this;
    }

    /**
     * Get the value of distance
     *
     * @return  integer|null
     */ 
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set the value of distance
     *
     * @param  integer|null  $distance
     *
     * @return  self
     */ 
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get the value of lat
     *
     * @return  float|null
     */ 
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * Set the value of lat
     *
     * @param  float|null  $lat
     *
     * @return  EvenementsSearch
     */ 
    public function setLat(?float $lat): EvenementsSearch
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get the value of lng
     *
     * @return  float|null
     */ 
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * Set the value of lng
     *
     * @param  float|null  $lng
     *
     * @return  EvenementsSearch
     */ 
    public function setLng(?float $lng): EvenementsSearch
    {
        $this->lng = $lng;

        return $this;
    }
}