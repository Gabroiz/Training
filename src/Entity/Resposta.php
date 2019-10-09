<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RespostaRepository")
 */
class Resposta
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
     * @ORM\Column(type="float")
     */
    private $pontuacao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Caso", inversedBy="respostas")
     */
    private $caso;

    /**
     * Resposta constructor.
     * @param $descricao
     * @param $pontuacao
     * @param $caso
     */
    public function __construct($descricao, $pontuacao, $caso)
    {
        $this->descricao = $descricao;
        $this->pontuacao = $pontuacao;
        $this->caso = $caso;
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

    public function getPontuacao(): ?float
    {
        return $this->pontuacao;
    }

    public function setPontuacao(float $pontuacao): self
    {
        $this->pontuacao = $pontuacao;

        return $this;
    }

    public function getCaso(): ?Caso
    {
        return $this->caso;
    }

    public function setCaso(?Caso $caso): self
    {
        $this->caso = $caso;

        return $this;
    }
}
