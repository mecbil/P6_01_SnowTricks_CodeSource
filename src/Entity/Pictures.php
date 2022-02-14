<?php

namespace App\Entity;

use App\Repository\PicturesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PicturesRepository::class)
 */
class Pictures
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message = "Veuillez compléter ce champ.")
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "Votre Titre doit comporter au moins {{ limit }} caractères ",
     * )
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Veuillez compléter ce champ.")
     * @Assert\Image(maxSize = "2M", 
     *              uploadIniSizeErrorMessage = "Fichier trop volumineux. La taille maximum autorisée est de : {{ limit }}M",
     *              mimeTypesMessage = "Ce fichier n'est pas une image valide.")
     * )
     */
    private $link;

    /**
     * @ORM\ManyToOne(targetEntity=Tricks::class, inversedBy="pictures")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $tricks;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getTricks(): ?tricks
    {
        return $this->tricks;
    }

    public function setTricks(?tricks $tricks): self
    {
        $this->tricks = $tricks;

        return $this;
    }
}
