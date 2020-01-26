<?php

namespace Entities;

/**
 * Calendario
 *
 * @Table(name="calendario", indexes={@Index(name="idUsuario", columns={"idUsuario"}), @Index(name="idOportunidad", columns={"idOportunidad"})})
 * @Entity(repositoryClass="Repositories\CalendarioRepositorio")
 */
class Calendario
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
     * @var \DateTime
     *
     * @Column(name="fecha", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @Column(name="year", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $year;

    /**
     * @var integer
     *
     * @Column(name="month", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $month;

    /**
     * @var integer
     *
     * @Column(name="day", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $day;

    /**
     * @var string
     *
     * @Column(name="hour", type="decimal", precision=4, scale=2, nullable=false, unique=false)
     */
    private $hour;

    /**
     * @var string
     *
     * @Column(name="comentario", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $comentario;

    /**
     * @var boolean
     *
     * @Column(name="estado", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $estado;

    /**
     * @var boolean
     *
     * @Column(name="checkIt", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $checkit = 0;

    /**
     * @var \Cuentas
     *
     * @ManyToOne(targetEntity="Cuentas")
     * @JoinColumns({
     *   @JoinColumn(name="idCliente", referencedColumnName="id", nullable=true)
     * })
     */
    private $idcliente;

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
        $this->estado = 0;
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Calendario
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Calendario
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set month
     *
     * @param integer $month
     *
     * @return Calendario
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return integer
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set day
     *
     * @param integer $day
     *
     * @return Calendario
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set hour
     *
     * @param string $hour
     *
     * @return Calendario
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return string
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     *
     * @return Calendario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Calendario
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set checkit
     *
     * @param boolean $checkit
     *
     * @return Calendario
     */
    public function setCheckit($checkit)
    {
        $this->checkit = $checkit;

        return $this;
    }

    /**
     * Get checkit
     *
     * @return boolean
     */
    public function getCheckit()
    {
        return $this->checkit;
    }

    /**
     * Set idcliente
     *
     * @param \Cuentas $idcliente
     *
     * @return Calendario
     */
    public function setIdcliente($idcliente)
    {
        $this->idcliente = $idcliente;

        return $this;
    }

    /**
     * Get idcliente
     *
     * @return \Cuentas
     */
    public function getIdcliente()
    {
        return $this->idcliente;
    }

    /**
     * Set idusuario
     *
     * @param \Usuarios $idusuario
     *
     * @return Calendario
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

    /**
     * Get cuentaseguimiento
     *
     * @return \Cuentasseguimiento
     */
    public function getCuentaseguimiento()
    {
        return $this->cuentaseguimiento;
    }
}

