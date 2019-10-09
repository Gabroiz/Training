<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TalentosRepository")
 */
class Talentos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $comunicador;

    /**
     * @ORM\Column(type="integer")
     */
    private $executor;

    /**
     * @ORM\Column(type="integer")
     */
    private $analista;

    /**
     * @ORM\Column(type="integer")
     */
    private $planejador;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComunicador(): ?int
    {
        return $this->comunicador;
    }

    public function setComunicador(int $comunicador): self
    {
        $this->comunicador = $comunicador;

        return $this;
    }

    public function getExecutor(): ?int
    {
        return $this->executor;
    }

    public function setExecutor(int $executor): self
    {
        $this->executor = $executor;

        return $this;
    }

    public function getAnalista(): ?int
    {
        return $this->analista;
    }

    public function setAnalista(int $analista): self
    {
        $this->analista = $analista;

        return $this;
    }

    public function getPlanejador(): ?int
    {
        return $this->planejador;
    }

    public function setPlanejador(int $planejador): self
    {
        $this->planejador = $planejador;

        return $this;
    }
}
