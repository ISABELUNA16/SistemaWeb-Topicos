<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paciente
 *
 * @ORM\Table(name="Paciente")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\PacienteRepository")
 */
class Paciente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_paciente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codPaciente;

    /**
     * @var string
     *
     * @ORM\Column(name="pac_nombre", type="string", length=50, nullable=true)
     */
    private $pacNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="pac_apaterno", type="string", length=50, nullable=true)
     */
    private $pacApaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="pac_amaterno", type="string", length=50, nullable=true)
     */
    private $pacAmaterno;

    /**
     * @var integer
     *
     * @ORM\Column(name="pac_dni", type="integer", nullable=true)
     */
    private $pacDni;

    /**
     * @var integer
     *
     * @ORM\Column(name="pac_genero", type="integer", nullable=true)
     */
    private $pacGenero;

    /**
     * @var string
     *
     * @ORM\Column(name="pac_area_trabajo", type="string", length=100, nullable=true)
     */
    private $pacAreaTrabajo;

    /**
     * @var string
     *
     * @ORM\Column(name="pac_sede", type="string", length=50, nullable=true)
     */
    private $pacSede;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_condicion", type="integer", nullable=true)
     */
    private $codCondicion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_seguro", type="integer", nullable=true)
     */
    private $codSeguro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pac_nacimiento", type="date", nullable=true)
     */
    private $pacNacimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="pac_lugar_nac", type="integer", nullable=true)
     */
    private $pacLugarNac;

    /**
     * @var integer
     *
     * @ORM\Column(name="pac_lugar_proc", type="integer", nullable=true)
     */
    private $pacLugarProc;

    /**
     * @var integer
     *
     * @ORM\Column(name="pac_telefono", type="integer", nullable=true)
     */
    private $pacTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="pac_direccion", type="text", length=-1, nullable=true)
     */
    private $pacDireccion;

    /**
     * @var string
     *
     * @ORM\Column(name="pac_profession", type="string", length=50, nullable=true)
     */
    private $pacProfession;

    /**
     * @var integer
     *
     * @ORM\Column(name="pac_servicio", type="integer", nullable=true)
     */
    private $pacServicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="pac_tipo_plaso", type="integer", nullable=true)
     */
    private $pacTipoPlaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="pac_estado_civil", type="integer", nullable=true)
     */
    private $pacEstadoCivil;

    /**
     * @var integer
     *
     * @ORM\Column(name="pac_num_hijo_vivos", type="integer", nullable=true)
     */
    private $pacNumHijoVivos;

    /**
     * @var integer
     *
     * @ORM\Column(name="pac_num_hijo_fallecidos", type="integer", nullable=true)
     */
    private $pacNumHijoFallecidos;



    /**
     * Get codPaciente
     *
     * @return integer
     */
    public function getCodPaciente()
    {
        return $this->codPaciente;
    }

    /**
     * Set pacNombre
     *
     * @param string $pacNombre
     *
     * @return Paciente
     */
    public function setPacNombre($pacNombre)
    {
        $this->pacNombre = $pacNombre;

        return $this;
    }

    /**
     * Get pacNombre
     *
     * @return string
     */
    public function getPacNombre()
    {
        return $this->pacNombre;
    }

    /**
     * Set pacApaterno
     *
     * @param string $pacApaterno
     *
     * @return Paciente
     */
    public function setPacApaterno($pacApaterno)
    {
        $this->pacApaterno = $pacApaterno;

        return $this;
    }

    /**
     * Get pacApaterno
     *
     * @return string
     */
    public function getPacApaterno()
    {
        return $this->pacApaterno;
    }

    /**
     * Set pacAmaterno
     *
     * @param string $pacAmaterno
     *
     * @return Paciente
     */
    public function setPacAmaterno($pacAmaterno)
    {
        $this->pacAmaterno = $pacAmaterno;

        return $this;
    }

    /**
     * Get pacAmaterno
     *
     * @return string
     */
    public function getPacAmaterno()
    {
        return $this->pacAmaterno;
    }

    /**
     * Set pacDni
     *
     * @param integer $pacDni
     *
     * @return Paciente
     */
    public function setPacDni($pacDni)
    {
        $this->pacDni = $pacDni;

        return $this;
    }

    /**
     * Get pacDni
     *
     * @return integer
     */
    public function getPacDni()
    {
        return $this->pacDni;
    }

    /**
     * Set pacGenero
     *
     * @param integer $pacGenero
     *
     * @return Paciente
     */
    public function setPacGenero($pacGenero)
    {
        $this->pacGenero = $pacGenero;

        return $this;
    }

    /**
     * Get pacGenero
     *
     * @return integer
     */
    public function getPacGenero()
    {
        return $this->pacGenero;
    }

    /**
     * Set pacAreaTrabajo
     *
     * @param string $pacAreaTrabajo
     *
     * @return Paciente
     */
    public function setPacAreaTrabajo($pacAreaTrabajo)
    {
        $this->pacAreaTrabajo = $pacAreaTrabajo;

        return $this;
    }

    /**
     * Get pacAreaTrabajo
     *
     * @return string
     */
    public function getPacAreaTrabajo()
    {
        return $this->pacAreaTrabajo;
    }

    /**
     * Set pacSede
     *
     * @param string $pacSede
     *
     * @return Paciente
     */
    public function setPacSede($pacSede)
    {
        $this->pacSede = $pacSede;

        return $this;
    }

    /**
     * Get pacSede
     *
     * @return string
     */
    public function getPacSede()
    {
        return $this->pacSede;
    }

    /**
     * Set codCondicion
     *
     * @param integer $codCondicion
     *
     * @return Paciente
     */
    public function setCodCondicion($codCondicion)
    {
        $this->codCondicion = $codCondicion;

        return $this;
    }

    /**
     * Get codCondicion
     *
     * @return integer
     */
    public function getCodCondicion()
    {
        return $this->codCondicion;
    }

    /**
     * Set codSeguro
     *
     * @param integer $codSeguro
     *
     * @return Paciente
     */
    public function setCodSeguro($codSeguro)
    {
        $this->codSeguro = $codSeguro;

        return $this;
    }

    /**
     * Get codSeguro
     *
     * @return integer
     */
    public function getCodSeguro()
    {
        return $this->codSeguro;
    }

    /**
     * Set pacNacimiento
     *
     * @param \DateTime $pacNacimiento
     *
     * @return Paciente
     */
    public function setPacNacimiento($pacNacimiento)
    {
        $this->pacNacimiento = $pacNacimiento;

        return $this;
    }

    /**
     * Get pacNacimiento
     *
     * @return \DateTime
     */
    public function getPacNacimiento()
    {
        return $this->pacNacimiento;
    }

    /**
     * Set pacLugarNac
     *
     * @param integer $pacLugarNac
     *
     * @return Paciente
     */
    public function setPacLugarNac($pacLugarNac)
    {
        $this->pacLugarNac = $pacLugarNac;

        return $this;
    }

    /**
     * Get pacLugarNac
     *
     * @return integer
     */
    public function getPacLugarNac()
    {
        return $this->pacLugarNac;
    }

    /**
     * Set pacLugarProc
     *
     * @param integer $pacLugarProc
     *
     * @return Paciente
     */
    public function setPacLugarProc($pacLugarProc)
    {
        $this->pacLugarProc = $pacLugarProc;

        return $this;
    }

    /**
     * Get pacLugarProc
     *
     * @return integer
     */
    public function getPacLugarProc()
    {
        return $this->pacLugarProc;
    }

    /**
     * Set pacTelefono
     *
     * @param integer $pacTelefono
     *
     * @return Paciente
     */
    public function setPacTelefono($pacTelefono)
    {
        $this->pacTelefono = $pacTelefono;

        return $this;
    }

    /**
     * Get pacTelefono
     *
     * @return integer
     */
    public function getPacTelefono()
    {
        return $this->pacTelefono;
    }

    /**
     * Set pacDireccion
     *
     * @param string $pacDireccion
     *
     * @return Paciente
     */
    public function setPacDireccion($pacDireccion)
    {
        $this->pacDireccion = $pacDireccion;

        return $this;
    }

    /**
     * Get pacDireccion
     *
     * @return string
     */
    public function getPacDireccion()
    {
        return $this->pacDireccion;
    }

    /**
     * Set pacProfession
     *
     * @param string $pacProfession
     *
     * @return Paciente
     */
    public function setPacProfession($pacProfession)
    {
        $this->pacProfession = $pacProfession;

        return $this;
    }

    /**
     * Get pacProfession
     *
     * @return string
     */
    public function getPacProfession()
    {
        return $this->pacProfession;
    }

    /**
     * Set pacServicio
     *
     * @param integer $pacServicio
     *
     * @return Paciente
     */
    public function setPacServicio($pacServicio)
    {
        $this->pacServicio = $pacServicio;

        return $this;
    }

    /**
     * Get pacServicio
     *
     * @return integer
     */
    public function getPacServicio()
    {
        return $this->pacServicio;
    }

    /**
     * Set pacTipoPlaso
     *
     * @param integer $pacTipoPlaso
     *
     * @return Paciente
     */
    public function setPacTipoPlaso($pacTipoPlaso)
    {
        $this->pacTipoPlaso = $pacTipoPlaso;

        return $this;
    }

    /**
     * Get pacTipoPlaso
     *
     * @return integer
     */
    public function getPacTipoPlaso()
    {
        return $this->pacTipoPlaso;
    }

    /**
     * Set pacEstadoCivil
     *
     * @param integer $pacEstadoCivil
     *
     * @return Paciente
     */
    public function setPacEstadoCivil($pacEstadoCivil)
    {
        $this->pacEstadoCivil = $pacEstadoCivil;

        return $this;
    }

    /**
     * Get pacEstadoCivil
     *
     * @return integer
     */
    public function getPacEstadoCivil()
    {
        return $this->pacEstadoCivil;
    }

    /**
     * Set pacNumHijoVivos
     *
     * @param integer $pacNumHijoVivos
     *
     * @return Paciente
     */
    public function setPacNumHijoVivos($pacNumHijoVivos)
    {
        $this->pacNumHijoVivos = $pacNumHijoVivos;

        return $this;
    }

    /**
     * Get pacNumHijoVivos
     *
     * @return integer
     */
    public function getPacNumHijoVivos()
    {
        return $this->pacNumHijoVivos;
    }

    /**
     * Set pacNumHijoFallecidos
     *
     * @param integer $pacNumHijoFallecidos
     *
     * @return Paciente
     */
    public function setPacNumHijoFallecidos($pacNumHijoFallecidos)
    {
        $this->pacNumHijoFallecidos = $pacNumHijoFallecidos;

        return $this;
    }

    /**
     * Get pacNumHijoFallecidos
     *
     * @return integer
     */
    public function getPacNumHijoFallecidos()
    {
        return $this->pacNumHijoFallecidos;
    }
}
