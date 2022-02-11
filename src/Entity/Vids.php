<?php

namespace App\Entity;

use App\Repository\VidsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=VidsRepository::class)
 * @UniqueEntity( fields={"link", "tricks"},
 *                 message="Cette valeur est déjà utilisée."
 *              )
 */
class Vids
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(message="Cette valeur n'est pas une URL valide.")
     */
    private $link;

    /**
     * @ORM\ManyToOne(targetEntity=Tricks::class, inversedBy="vids")
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
