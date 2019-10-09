<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="candidato")
 * @ORM\Entity(repositoryClass="App\Repository\CandidatoRepository")
 */
class Candidato
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $autoDescricao;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Endereco", cascade={"persist", "remove"})
     */
    private $endereco;

    /**
     * @ORM\Column(type="float")
     */
    private $pontuacao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Feedback", mappedBy="candidato")
     */
    private $feedback;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Talentos", cascade={"persist", "remove"})
     */
    private $talentos;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Usuario", mappedBy="candidato", cascade={"persist", "remove"})
     */
    private $usuario;

    public function __construct()
    {
        $this->feedback = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutoDescricao(): ?string
    {
        return $this->autoDescricao;
    }

    public function setAutoDescricao(?string $autoDescricao): self
    {
        $this->autoDescricao = $autoDescricao;

        return $this;
    }

    public function getEndereco(): ?Endereco
    {
        return $this->endereco;
    }

    public function setEndereco(?Endereco $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getPontuacao(): ?float
    {
        return $this->pontuacao;
    }

    public function setPontuacao(float $pontuacao): self
    {
        $this->pontuacao = $pontuacao;

        return $this;
    }

    /**
     * @return Collection|Feedback[]
     */
    public function getFeedback(): Collection
    {
        return $this->feedback;
    }

    public function addFeedback(Feedback $feedback): self
    {
        if (!$this->feedback->contains($feedback)) {
            $this->feedback[] = $feedback;
            $feedback->setCandidato($this);
        }

        return $this;
    }

    public function removeFeedback(Feedback $feedback): self
    {
        if ($this->feedback->contains($feedback)) {
            $this->feedback->removeElement($feedback);
            // set the owning side to null (unless already changed)
            if ($feedback->getCandidato() === $this) {
                $feedback->setCandidato(null);
            }
        }

        return $this;
    }

    public function getTalentos(): ?Talentos
    {
        return $this->talentos;
    }

    public function setTalentos(?Talentos $talentos): self
    {
        $this->talentos = $talentos;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

}
