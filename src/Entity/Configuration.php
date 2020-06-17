<?php

namespace App\Entity;

use App\Repository\ConfigurationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ConfigurationRepository::class)
 * @Vich\Uploadable
 */
class Configuration
{
    const STYLE = [
        "Default" => "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\">",
        "darkly" =>"<link href=\"https://stackpath.bootstrapcdn.com/bootswatch/4.5.0/darkly/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-Bo21yfmmZuXwcN/9vKrA5jPUMhr7znVBBeLxT9MA4r2BchhusfJ6+n8TLGUcRAtL\" crossorigin=\"anonymous\">",
        "journal" => "<link href=\"https://stackpath.bootstrapcdn.com/bootswatch/4.5.0/journal/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-vjBZc/DqIqR687k5rf6bUQ6IVSOxQUi9TcwtvULstA7+YGi//g3oT2qkh8W1Drx9\" crossorigin=\"anonymous\">",
        "minty"  => "<link href=\"https://stackpath.bootstrapcdn.com/bootswatch/4.5.0/minty/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-HqaYdAE26lgFCJsUF9TBdbZf7ygr9yPHtxtg37JshqVQi6CCAo6Qvwmgc5xclIiV\" crossorigin=\"anonymous\">",
        "superhero" =>"<link href=\"https://stackpath.bootstrapcdn.com/bootswatch/4.5.0/superhero/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-rvwYMW9Z/bbxZfgxHQEKx6D91KwffWAG+XnsoYNCGWi/qL1P9dIVYm1HBiHFqQEt\" crossorigin=\"anonymous\">"
        ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;


    /**
     * @var string|null
     * @ORM\Column(type="string")
     */
    private $style;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @var File|null
     * @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/gif"})
     * @Vich\UploadableField(mapping="configuration_image", fileNameProperty="filename")
     */
    private $imageFile;



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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(int $style): self
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Configuration
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile): Configuration
    {
        $this->imageFile = $imageFile;
        return $this;
    }
}
