<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pruebita
 *
 * @ORM\Table(name="pruebita")
 * @ORM\Entity(repositoryClass="App\Repository\PruebitaRepository")
 */
class Pruebita
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descrip", type="string", length=50, nullable=false)
     */
    private $descrip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="f_alta", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $fAlta = 'current_timestamp()';

    /**
     * @var int
     *
     * @ORM\Column(name="usr_alta", type="integer", nullable=false)
     */
    private $usrAlta;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescrip(): ?string
    {
        return $this->descrip;
    }

    public function setDescrip(string $descrip): self
    {
        $this->descrip = $descrip;

        return $this;
    }

    public function getFAlta(): ?\DateTimeInterface
    {
        return $this->fAlta;
    }

    public function setFAlta(\DateTimeInterface $fAlta): self
    {
        $this->fAlta = $fAlta;

        return $this;
    }

    public function getUsrAlta(): ?int
    {
        return $this->usrAlta;
    }

    public function setUsrAlta(int $usrAlta): self
    {
        $this->usrAlta = $usrAlta;

        return $this;
    }


}
