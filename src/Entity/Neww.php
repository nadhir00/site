<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass=App\Repository\NewwRepository::class)
 * @Vich\Uploadable
 */
class Neww
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Vich\UploadableField(mapping="image", fileNameProperty="picture")
     * @var File|null
     * 
     */
    private $imaggeFile;
    
    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $picture;

   
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }
   

    public function setImaggeFile(?File $imaggeFile = null): void
    {
        $this->imaggeFile = $imaggeFile;

        if (null !== $imaggeFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImaggeFile(): ?File
    {
        return $this->imaggeFile;
    }
    

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
