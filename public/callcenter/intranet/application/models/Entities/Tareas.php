<?php

namespace Entities;

/**
 * Tareas
 *
 * @Table(name="tareas", indexes={@Index(name="idUsuario", columns={"idUsuarioFrom"}), @Index(name="idUsuarioTo", columns={"idUsuarioTo"}), @Index(name="idCalendario", columns={"idCalendario"}), @Index(name="idCliente", columns={"idCliente"})})
 @Entity(repositoryClass="Repositories\TareasRepositorio")
 */
class Tareas
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
     * @var boolean
     *
     * @Column(name="estado", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $estado = 0;

    /**
     * @var \DateTime
     *
     * @Column(name="fAlta", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $falta;

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
     *   @JoinColumn(name="idUsuarioFrom", referencedColumnName="id", nullable=true)
     * })
     */
    private $idusuariofrom;

    /**
     * @var \Usuarios
     *
     * @ManyToOne(targetEntity="Usuarios")
     * @JoinColumns({
     *   @JoinColumn(name="idUsuarioTo", referencedColumnName="id", nullable=true)
     * })
     */
    private $idusuarioto;

    /**
     * @var \Calendario
     *
     * @ManyToOne(targetEntity="Calendario")
     * @JoinColumns({
     *   @JoinColumn(name="idCalendario", referencedColumnName="id", nullable=true)
     * })
     */
    private $idcalendario;

    /**
     * @var string
     *
     * @Column(name="tipo", type="decimal", precision=4, scale=25, nullable=true, unique=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @Column(name="texto", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $texto;

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
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Tareas
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
     * Set falta
     *
     * @param \DateTime $falta
     *
     * @return Tareas
     */
    public function setFalta($falta)
    {
        $this->falta = $falta;

        return $this;
    }

    /**
     * Get falta
     *
     * @return \DateTime
     */
    public function getFalta()
    {
        return $this->falta;
    }

    /**
     * Set idcliente
     *
     * @param \Cuentas $idcliente
     *
     * @return Tareas
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
     * Set idusuariofrom
     *
     * @param \Usuarios $idusuariofrom
     *
     * @return Tareas
     */
    public function setIdusuariofrom($idusuariofrom)
    {
        $this->idusuariofrom = $idusuariofrom;

        return $this;
    }

    /**
     * Get idusuariofrom
     *
     * @return \Usuarios
     */
    public function getIdusuariofrom()
    {
        return $this->idusuariofrom;
    }

    /**
     * Set idusuarioto
     *
     * @param \Usuarios $idusuarioto
     *
     * @return Tareas
     */
    public function setIdusuarioto($idusuarioto)
    {
        $this->idusuarioto = $idusuarioto;

        return $this;
    }

    /**
     * Get idusuarioto
     *
     * @return \Usuarios
     */
    public function getIdusuarioto()
    {
        return $this->idusuarioto;
    }

    /**
     * Set idcalendario
     *
     * @param \Calendario $idcalendario
     *
     * @return Tareas
     */
    public function setIdcalendario($idcalendario)
    {
        $this->idcalendario = $idcalendario;

        return $this;
    }

    /**
     * Get idcalendario
     *
     * @return \Calendario
     */
    public function getIdcalendario()
    {
        return $this->idcalendario;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Calendario
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set texto
     *
     * @param string $texto
     *
     * @return Reportes
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }
}

