<?php

namespace Entities;

/**
 * Precontactos
 *
 * @Table(name="precontactos", indexes={@Index(name="idUsuario", columns={"idUsuario"})})
 * @Entity(repositoryClass="Repositories\PrecontactosRepositorio")
 */
class Precontactos
{
    /**
     * @var integer
     *
     * @Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="nombre", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @Column(name="telefono", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $telefono;

    /**
     * @var integer
     *
     * @Column(name="movil", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $movil;

    /**
     * @var string
     *
     * @Column(name="poblacion", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     */
    private $poblacion;

    /**
     * @var integer
     *
     * @Column(name="cp", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $cp;

    /**
     * @var \Date
     *
     * @Column(name="fAlta", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $falta;

    /**
     * @var \Usuarios
     *
     * @ManyToOne(targetEntity="Usuarios")
     * @JoinColumns({
     *   @JoinColumn(name="idUsuario", referencedColumnName="id", nullable=true)
     * })
     */
    private $idusuario;

    public function __construct()
    {
        $this->falta = new \DateTime("now");
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Precontactos
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     *
     * @return Precontactos
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set movil
     *
     * @param integer $movil
     *
     * @return Precontactos
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;

        return $this;
    }

    /**
     * Get movil
     *
     * @return integer
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set poblacion
     *
     * @param string $poblacion
     *
     * @return Precontactos
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    /**
     * Get poblacion
     *
     * @return string
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * Set cp
     *
     * @param integer $cp
     *
     * @return Precontactos
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return integer
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set falta
     *
     * @param \Date $falta
     *
     * @return Precontactos
     */
    public function setFalta($falta)
    {
        $this->falta = $falta;

        return $this;
    }

    /**
     * Get falta
     *
     * @return \Date
     */
    public function getFalta()
    {
        return $this->falta;
    }

    /**
     * Set idusuario
     *
     * @param \Usuarios $idusuario
     *
     * @return Precontactos
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get idusuario
     *
     * @return \Usuarios
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }
}

