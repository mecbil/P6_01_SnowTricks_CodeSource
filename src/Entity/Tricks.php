<?php

namespace App\Entity;

use App\Repository\TricksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TricksRepository::class)
 */
class Tricks
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
     * @ORM\Column(type="string", length=100)
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modifyAt;

    /**
     * @ORM\Column(type="text")
     */
    private $fitured_img;

    /**
     * @ORM\ManyToOne(targetEntity=users::class, inversedBy="tricks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=categories::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Vids::class, mappedBy="tricks")
     */
    private $vids;

    /**
     * @ORM\OneToMany(targetEntity=Pictures::class, mappedBy="tricks")
     */
    private $pictures;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="tricks")
     */
    private $tricks;

    public function __construct()
    {
        $this->vids = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->tricks = new ArrayCollection();
    }

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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getModifyAt(): ?\DateTimeInterface
    {
        return $this->modifyAt;
    }

    public function setModifyAt(\DateTimeInterface $modifyAt): self
    {
        $this->modifyAt = $modifyAt;

        return $this;
    }

    public function getFituredImg(): ?string
    {
        return $this->fitured_img;
    }

    public function setFituredImg(string $fitured_img): self
    {
        $this->fitured_img = $fitured_img;

        return $this;
    }

    public function getUsers(): ?users
    {
        return $this->users;
    }

    public function setUsers(?users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getCategories(): ?categories
    {
        return $this->categories;
    }

    public function setCategories(?categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection|Vids[]
     */
    public function getVids(): Collection
    {
        return $this->vids;
    }

    public function addVid(Vids $vid): self
    {
        if (!$this->vids->contains($vid)) {
            $this->vids[] = $vid;
            $vid->setTricks($this);
        }

        return $this;
    }

    public function removeVid(Vids $vid): self
    {
        if ($this->vids->removeElement($vid)) {
            // set the owning side to null (unless already changed)
            if ($vid->getTricks() === $this) {
                $vid->setTricks(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pictures[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setTricks($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getTricks() === $this) {
                $picture->setTricks(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getTricks(): Collection
    {
        return $this->tricks;
    }

    public function addTrick(Comments $trick): self
    {
        if (!$this->tricks->contains($trick)) {
            $this->tricks[] = $trick;
            $trick->setTricks($this);
        }

        return $this;
    }

    public function removeTrick(Comments $trick): self
    {
        if ($this->tricks->removeElement($trick)) {
            // set the owning side to null (unless already changed)
            if ($trick->getTricks() === $this) {
                $trick->setTricks(null);
            }
        }

        return $this;
    }
}
