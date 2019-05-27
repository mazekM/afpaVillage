<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementsRepository")
 * @UniqueEntity("title")
 */
class Evenements 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $title;
    
    /**
     * * @ORM\Column(type="string",length=255)
     */
    private $category;
    
    /**
     * * @ORM\Column(type="text")
     */
    private $description;

    /**
     * 
     * @var string A "Y-m-d H:i:s" formatted value
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="float", scale=4, precision=6)
     */
    private $lat;

    /**
     * @ORM\Column(type="float", scale=4, precision=7)
     */
    private $lng;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="evenements", orphanRemoval=true, cascade={"persist"})
     */
    private $pictures;

    /**
     * @Assert\All({
     *   @Assert\Image(mimeTypes="image/jpeg")
     * })
     */
    private $pictureFiles;

    public function __construct()
    {
        $this->updated_at= new \DateTime();
        $this->pictures = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getCategory()
    {
        return $this->category;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function setTitle($title)
    {
        $this->title=$title;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
    }

    public function setCategory($category)
    {
        $this->category=$category;
    }
    public function setDescription($description)
    {
        $this->description=$description;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }
    
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function getPicture(): ?Picture
    {
        if($this->pictures->isEmpty()){
            return null;
        }
            return $this->pictures->first();
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setEvenements($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getEvenements() === $this) {
                $picture->setEvenements(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */ 
    public function getPictureFiles()
    {
        return $this->pictureFiles;
    }

    /**
     * @param mixed $pictureFiles
     * @return Evenements
     */ 
    public function setPictureFiles($pictureFiles): self
    {
        foreach($pictureFiles as $pictureFile){
            $picture = new Picture();
            $picture->setImageFile($pictureFile);
            $this->addPicture($picture);
        }
        $this->pictureFiles = $pictureFiles;
        return $this;
    }
}
