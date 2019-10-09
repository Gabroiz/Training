<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CasoRepository")
 */
class Caso
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
    private $titulo;

    /**
     * @ORM\Column(type="text")
     */
    private $descricao;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pergunta;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Feedback", cascade={"persist", "remove"})
     */
    private $feedback;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imagens;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $videos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $arquivos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resposta", mappedBy="caso", cascade={"persist", "remove"})
     */
    private $respostas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Area", inversedBy="casos")
     */
    private $area;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataDeCriacao;

    public function __construct()
    {
        $this->respostas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
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

    public function getPergunta(): ?string
    {
        return $this->pergunta;
    }

    public function setPergunta(string $pergunta): self
    {
        $this->pergunta = $pergunta;

        return $this;
    }

    public function getFeedback(): ?Feedback
    {
        return $this->feedback;
    }

    public function setFeedback(?Feedback $feedback): self
    {
        $this->feedback = $feedback;

        return $this;
    }

    public function getImagens(): ?string
    {
        return $this->imagens;
    }

    public function setImagens(?string $imagens): self
    {
        $this->imagens = $imagens;

        return $this;
    }

    public function getVideos(): ?string
    {
        return $this->videos;
    }

    public function setVideos(?string $videos): self
    {
        $this->videos = $videos;

        return $this;
    }

    public function getArquivos(): ?string
    {
        return $this->arquivos;
    }

    public function setArquivos(?string $arquivos): self
    {
        $this->arquivos = $arquivos;

        return $this;
    }

    /**
     * @return Collection|Resposta[]
     */
    public function getRespostas(): Collection
    {
        return $this->respostas;
    }

    public function addResposta(Resposta $resposta): self
    {
        if (!$this->respostas->contains($resposta)) {
            $this->respostas[] = $resposta;
            $resposta->setCaso($this);
        }

        return $this;
    }

    public function removeResposta(Resposta $resposta): self
    {
        if ($this->respostas->contains($resposta)) {
            $this->respostas->removeElement($resposta);
            // set the owning side to null (unless already changed)
            if ($resposta->getCaso() === $this) {
                $resposta->setCaso(null);
            }
        }

        return $this;
    }

    public function getArea(): ?Area
    {
        return $this->area;
    }

    public function setArea(?Area $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getDataDeCriacao(): ?\DateTimeInterface
    {
        return $this->dataDeCriacao;
    }

    public function setDataDeCriacao(\DateTimeInterface $dataDeCriacao): self
    {
        $this->dataDeCriacao = $dataDeCriacao;

        return $this;
    }
}
