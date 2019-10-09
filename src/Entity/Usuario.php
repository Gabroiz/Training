<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario implements UserInterface, Serializable
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
    private $sobrenome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cpf;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataDeNascimento;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefone;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imagem;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Area", inversedBy="usuario")
     */
    private $area;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Candidato", inversedBy="usuario", cascade={"persist", "remove"})
     */
    private $candidato;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Contratador", inversedBy="usuario", cascade={"persist", "remove"})
     */
    private $contratador;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Recrutador", inversedBy="usuario", cascade={"persist", "remove"})
     */
    private $recrutador;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Gestor", inversedBy="usuario", cascade={"persist", "remove"})
     */
    private $gestor;

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

    public function getSobrenome(): ?string
    {
        return $this->sobrenome;
    }

    public function setSobrenome(string $sobrenome): self
    {
        $this->sobrenome = $sobrenome;

        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getDataDeNascimento(): ?\DateTimeInterface
    {
        return $this->dataDeNascimento;
    }

    public function setDataDeNascimento(\DateTimeInterface $dataDeNascimento): self
    {
        $this->dataDeNascimento = $dataDeNascimento;

        return $this;
    }

    public function getIdade()
    {
        $agora = new \DateTime('now');
        $dataDeNascimento = $this->getDataDeNascimento();
        $difference = $agora->diff($dataDeNascimento);

        return $difference->format('%y anos');
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

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword($password, $encrypt = true): self
    {
        if($encrypt)
            $this->password = password_hash($password,1,["cost" => 12]);
        else
            $this->password = $password;

        return $this;
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->nome,
            $this->sobrenome,
            $this->email,
            $this->password
        ]);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->nome,
            $this->sobrenome,
            $this->email,
            $this->password
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    public function getRoles()
    {
        if (!empty($this->candidato)){
            return array("ROLE_CANDIDATO");
        } elseif (!empty($this->gestor)){
            return array("ROLE_GESTOR");
        } elseif (!empty($this->recrutador )){
            return array("ROLE_RECRUTADOR");
        } elseif (!empty($this->contratador )){
            return array("ROLE_CONTRATADOR");
        }
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        return false;
    }

    public function getImagem(): ?string
    {
        return $this->imagem;
    }

    public function setImagem(?string $imagem): self
    {
        $this->imagem = $imagem;

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

    public function getCandidato()
    {
        return $this->candidato;
    }

    public function setCandidato(?Candidato $candidato): self
    {
        $this->candidato = $candidato;

        return $this;
    }

    public function getContratador()
    {
        return $this->contratador;
    }

    public function setContratador(?Contratador $contratador): self
    {
        $this->contratador = $contratador;

        return $this;
    }

    public function getRecrutador()
    {
        return $this->recrutador;
    }

    public function setRecrutador(?Contratador $recrutador): self
    {
        $this->recrutador = $recrutador;

        return $this;
    }

    public function getGestor()
    {
        return $this->gestor;
    }

    public function setGestor(?Contratador $gestor): self
    {
        $this->gestor = $gestor;

        return $this;
    }
}
