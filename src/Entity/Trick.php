<?php

namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
class Trick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameTrick = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\ManyToOne(inversedBy: 'tricks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'tricks', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\ManyToOne(inversedBy: 'tricks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GroupTrick $groupTrick = null;

    #[ORM\OneToMany(mappedBy: 'tricks', targetEntity: PhotoTrick::class)]
    private Collection $photoTricks;

    #[ORM\OneToMany(mappedBy: 'tricks', targetEntity: VideoTrick::class)]
    private Collection $videoTricks;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->photoTricks = new ArrayCollection();
        $this->videoTricks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameTrick(): ?string
    {
        return $this->nameTrick;
    }

    public function setNameTrick(string $nameTrick): self
    {
        $this->nameTrick = $nameTrick;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreationDate(): \DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setTrick($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getTrick() === $this) {
                $comment->setTrick(null);
            }
        }

        return $this;
    }

    public function getGroupTrick(): ?GroupTrick
    {
        return $this->groupTrick;
    }

    public function setGroupTrick(?GroupTrick $groupTrick): self
    {
        $this->groupTrick = $groupTrick;

        return $this;
    }

    /**
     * @return Collection<int, PhotoTrick>
     */
    public function getPhotoTricks(): Collection
    {
        return $this->photoTricks;
    }

    public function addPhotoTrick(PhotoTrick $photoTrick): self
    {
        if (!$this->photoTricks->contains($photoTrick)) {
            $this->photoTricks->add($photoTrick);
            $photoTrick->setTrick($this);
        }

        return $this;
    }

    public function removePhotoTrick(PhotoTrick $photoTrick): self
    {
        if ($this->photoTricks->removeElement($photoTrick)) {
            // set the owning side to null (unless already changed)
            if ($photoTrick->getTrick() === $this) {
                $photoTrick->setTrick(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VideoTrick>
     */
    public function getVideoTricks(): Collection
    {
        return $this->videoTricks;
    }

    public function addVideoTrick(VideoTrick $videoTrick): self
    {
        if (!$this->videoTricks->contains($videoTrick)) {
            $this->videoTricks->add($videoTrick);
            $videoTrick->setTrick($this);
        }

        return $this;
    }

    public function removeVideoTrick(VideoTrick $videoTrick): self
    {
        if ($this->videoTricks->removeElement($videoTrick)) {
            // set the owning side to null (unless already changed)
            if ($videoTrick->getTrick() === $this) {
                $videoTrick->setTrick(null);
            }
        }

        return $this;
    }
}
