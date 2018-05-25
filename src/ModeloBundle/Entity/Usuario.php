<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="Usuario")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\UsuarioRepository")
 */
class Usuario implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codUser;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=50, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="user_pasword", type="text", length=-1, nullable=true)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="percodigo", type="integer", nullable=true)
     */
    private $percodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=50, nullable=true)
     */
    private $userEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_perfil", type="integer", nullable=true)
     */
    private $userPerfil;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_fec_reg", type="datetime", nullable=true)
     */
    private $userFecReg = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="user_estado", type="integer", nullable=true)
     */
    private $userEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="json_array")
     */
    private $roles = array();


    /*Implementación para el logueo*/

    public function getUsername(){
        return $this->userName;
    }

    public function getSalt(){
        return null;
    }

    public function getRoles(){
        return $this->roles;
    }

    public function eraseCredentials(){
        
    }

     /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

     /**
     * Get password
     *
     * @return int
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Get codUser
     *
     * @return integer
     */
    public function getCodUser()
    {
        return $this->codUser;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set percodigo
     *
     * @param integer $percodigo
     *
     * @return Usuario
     */
    public function setPercodigo($percodigo)
    {
        $this->percodigo = $percodigo;

        return $this;
    }

    /**
     * Get percodigo
     *
     * @return integer
     */
    public function getPercodigo()
    {
        return $this->percodigo;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     *
     * @return Usuario
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userPerfil
     *
     * @param integer $userPerfil
     *
     * @return Usuario
     */
    public function setUserPerfil($userPerfil)
    {
        $this->userPerfil = $userPerfil;

        return $this;
    }

    /**
     * Get userPerfil
     *
     * @return integer
     */
    public function getUserPerfil()
    {
        return $this->userPerfil;
    }

    /**
     * Set userFecReg
     *
     * @param \DateTime $userFecReg
     *
     * @return Usuario
     */
    public function setUserFecReg($userFecReg)
    {
        $this->userFecReg = $userFecReg;

        return $this;
    }

    /**
     * Get userFecReg
     *
     * @return \DateTime
     */
    public function getUserFecReg()
    {
        return $this->userFecReg;
    }

    /**
     * Set userEstado
     *
     * @param integer $userEstado
     *
     * @return Usuario
     */
    public function setUserEstado($userEstado)
    {
        $this->userEstado = $userEstado;

        return $this;
    }

    /**
     * Get userEstado
     *
     * @return integer
     */
    public function getUserEstado()
    {
        return $this->userEstado;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return Usuario
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
}
