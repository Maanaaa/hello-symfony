<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)] private ?string $name = null;


    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Code::class)]
    private Collection $codes;

    public function __construct()
    {
        $this->codes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    /** @return Collection<int, Code> */
    public function getCodes(): Collection
    {
        return $this->codes;
    }

    public function addCode(Code $code): static
    {
        if (!$this->codes->contains($code)) {
            $this->codes->add($code);
            $code->setCategory($this);
        }
        return $this;
    }

    public function removeCode(Code $code): static
    {
        if ($this->codes->removeElement($code) && $code->getCategory() === $this) {
            $code->setCategory(null);
        }
        return $this;
    }
}
