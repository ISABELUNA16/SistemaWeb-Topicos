<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tantecedente
 *
 * @ORM\Table(name="Tantecedente")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\TantecedenteRepository")
 */
class Tantecedente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_tantecedente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codTantecedente;

    /**
     * @var string
     *
     * @ORM\Column(name="tant_descripcion", type="string", length=50, nullable=true)
     */
    private $tantDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tant_estado", type="integer", nullable=true)
     */
    private $tantEstado;



    /**
     * Get codTantecedente
     *
     * @return integer
     */
    public function getCodTantecedente()
    {
        return $this->codTantecedente;
    }

    /**
     * Set tantDescripcion
     *
     * @param string $tantDescripcion
     *
     * @return Tantecedente
     */
    public function setTantDescripcion($tantDescripcion)
    {
        $this->tantDescripcion = $tantDescripcion;

        return $this;
    }

    /**
     * Get tantDescripcion
     *
     * @return string
     */
    public function getTantDescripcion()
    {
        return $this->tantDescripcion;
    }

    /**
     * Set tantEstado
     *
     * @param integer $tantEstado
     *
     * @return Tantecedente
     */
    public function setTantEstado($tantEstado)
    {
        $this->tantEstado = $tantEstado;

        return $this;
    }

    /**
     * Get tantEstado
     *
     * @return integer
     */
    public function getTantEstado()
    {
        return $this->tantEstado;
    }
}
