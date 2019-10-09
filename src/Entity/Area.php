<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AreaRepository")
 */
class Area
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
    private $nome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Caso", mappedBy="area")
     */
    private $casos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Usuario", mappedBy="area")
     */
    private $usuario;

    public function __construct()
    {
        $this->casos = new ArrayCollection();
        $this->candidatos = new ArrayCollection();
        $this->usuario = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getIcone(): ?string
    {
        return $this->icone;
    }

    public function setIcone(string $icone): self
    {
        $this->icone = $icone;

        return $this;
    }

    /**
     * @return Collection|Caso[]
     */
    public function getCasos(): Collection
    {
        return $this->casos;
    }

    public function addCaso(Caso $caso): self
    {
        if (!$this->casos->contains($caso)) {
            $this->casos[] = $caso;
            $caso->setArea($this);
        }

        return $this;
    }

    public function removeCaso(Caso $caso): self
    {
        if ($this->casos->contains($caso)) {
            $this->casos->removeElement($caso);
            // set the owning side to null (unless already changed)
            if ($caso->getArea() === $this) {
                $caso->setArea(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Usuario[]
     */
    public function getUsuario(): Collection
    {
        return $this->usuario;
    }

    public function addUsuario(Usuario $usuario): self
    {
        if (!$this->usuario->contains($usuario)) {
            $this->usuario[] = $usuario;
            $usuario->setArea($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): self
    {
        if ($this->usuario->contains($usuario)) {
            $this->usuario->removeElement($usuario);
            // set the owning side to null (unless already changed)
            if ($usuario->getArea() === $this) {
                $usuario->setArea(null);
            }
        }

        return $this;
    }
}
