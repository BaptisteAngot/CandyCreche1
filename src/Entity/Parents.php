<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParentsRepository")
 */
class Parents
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parents_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parents_firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parents_mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parents_password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $parents_created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $parents_updated_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Child", mappedBy="Child_id_parent")
     */
    private $children;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Opinion", mappedBy="opinion_id_parents")
     */
    private $opinions;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->opinions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentsName(): ?string
    {
        return $this->parents_name;
    }

    public function setParentsName(string $parents_name): self
    {
        $this->parents_name = $parents_name;

        return $this;
    }

    public function getParentsFirstname(): ?string
    {
        return $this->parents_firstname;
    }

    public function setParentsFirstname(string $parents_firstname): self
    {
        $this->parents_firstname = $parents_firstname;

        return $this;
    }

    public function getParentsMail(): ?string
    {
        return $this->parents_mail;
    }

    public function setParentsMail(string $parents_mail): self
    {
        $this->parents_mail = $parents_mail;

        return $this;
    }

    public function getParentsPassword(): ?string
    {
        return $this->parents_password;
    }

    public function setParentsPassword(string $parents_password): self
    {
        $this->parents_password = $parents_password;

        return $this;
    }

    public function getParentsCreatedAt(): ?\DateTimeInterface
    {
        return $this->parents_created_at;
    }

    public function setParentsCreatedAt(\DateTimeInterface $parents_created_at): self
    {
        $this->parents_created_at = $parents_created_at;

        return $this;
    }

    public function getParentsUpdatedAt(): ?\DateTimeInterface
    {
        return $this->parents_updated_at;
    }

    public function setParentsUpdatedAt(?\DateTimeInterface $parents_updated_at): self
    {
        $this->parents_updated_at = $parents_updated_at;

        return $this;
    }

    /**
     * @return Collection|Child[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(Child $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setChildIdParent($this);
        }

        return $this;
    }

    public function removeChild(Child $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getChildIdParent() === $this) {
                $child->setChildIdParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Opinion[]
     */
    public function getOpinions(): Collection
    {
        return $this->opinions;
    }

    public function addOpinion(Opinion $opinion): self
    {
        if (!$this->opinions->contains($opinion)) {
            $this->opinions[] = $opinion;
            $opinion->setOpinionIdParents($this);
        }

        return $this;
    }

    public function removeOpinion(Opinion $opinion): self
    {
        if ($this->opinions->contains($opinion)) {
            $this->opinions->removeElement($opinion);
            // set the owning side to null (unless already changed)
            if ($opinion->getOpinionIdParents() === $this) {
                $opinion->setOpinionIdParents(null);
            }
        }

        return $this;
    }
}
