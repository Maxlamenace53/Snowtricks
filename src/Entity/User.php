<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $nickname = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $registrationDate = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Trick::class)]
    private Collection $Trick;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: PhotoTrick::class)]
    private Collection $photoTricks;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: VideoTrick::class)]
    private Collection $videoTricks;

    public function __construct()
    {
        $this->Trick = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->photoTricks = new ArrayCollection();
        $this->videoTricks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

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

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * @return Collection<int, Trick>
     */
    public function getTrick(): Collection
    {
        return $this->Trick;
    }

    public function addTrick(Trick $trick): self
    {
        if (!$this->Trick->contains($trick)) {
            $this->Trick->add($trick);
            $trick->setUser($this);
        }

        return $this;
    }

    public function removeTrick(Trick $trick): self
    {
        if ($this->Trick->removeElement($trick)) {
            // set the owning side to null (unless already changed)
            if ($trick->getUser() === $this) {
                $trick->setUser(null);
            }
        }

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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

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
            $photoTrick->setUser($this);
        }

        return $this;
    }

    public function removePhotoTrick(PhotoTrick $photoTrick): self
    {
        if ($this->photoTricks->removeElement($photoTrick)) {
            // set the owning side to null (unless already changed)
            if ($photoTrick->getUser() === $this) {
                $photoTrick->setUser(null);
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
            $videoTrick->setUser($this);
        }

        return $this;
    }

    public function removeVideoTrick(VideoTrick $videoTrick): self
    {
        if ($this->videoTricks->removeElement($videoTrick)) {
            // set the owning side to null (unless already changed)
            if ($videoTrick->getUser() === $this) {
                $videoTrick->setUser(null);
            }
        }

        return $this;
    }
}
