<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeedbackRepository")
 */
class Feedback
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Candidato", inversedBy="feedback")
     */
    private $candidato;

    /**
     * Feedback constructor.
     * @param $descricao
     */
    public function __construct($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getCandidato(): ?Candidato
    {
        return $this->candidato;
    }

    public function setCandidato(?Candidato $candidato): self
    {
        $this->candidato = $candidato;

        return $this;
    }
}
