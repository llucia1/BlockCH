<?php
namespace Entities;

/**
 * Cuentasseguimiento
 *
 * @Table(name="cuentasSeguimiento", indexes={@Index(name="idEstadoSeguimiento", columns={"idUsuario", "idCliente"}), @Index(name="idCalendario", columns={"idCalendario"}), @Index(name="idEstado", columns={"idEstado"}), @Index(name="idCliente", columns={"idCliente"}), @Index(name="IDX_89C2BF2032DCDBAF", columns={"idUsuario"})})
 * @Entity
 */
class Cuentasseguimiento
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
     * @Column(name="tipo", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $tipo;

    /**
     * @var boolean
     *
     * @Column(name="realizado", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $realizado = 0;

    /**
     * @var boolean
     *
     * @Column(name="actual", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $actual = 1;

    /**
     * @var boolean
     *
     * @Column(name="estado", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $estado = 1;

    /**
     * @var \DateTime
     *
     * @Column(name="fAlta", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $falta;

    /**
     * @var \DateTime
     *
     * @Column(name="fSeguimiento", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $fseguimiento;

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
     * @var \Estadosseguimiento
     *
     * @ManyToOne(targetEntity="Estadosseguimiento")
     * @JoinColumns({
     *   @JoinColumn(name="idEstado", referencedColumnName="id", nullable=true)
     * })
     */
    private $idestado;

    /**
     * @var \Usuarios
     *
     * @ManyToOne(targetEntity="Usuarios")
     * @JoinColumns({
     *   @JoinColumn(name="idUsuario", referencedColumnName="id", nullable=true)
     * })
     */
    private $idusuario;

    /**
     * @var \Usuarios
     *
     * @ManyToOne(targetEntity="Usuarios")
     * @JoinColumns({
     *   @JoinColumn(name="idTeleoperador", referencedColumnName="id", nullable=true)
     * })
     */
    private $idteleoperador;

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
     * @var integer
     *
     * @Column(name="codeAlta", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $codealta;

    public function __construct()
    {
        $this->codealta = date('Ymd');
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Cuentasseguimiento
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
     * Set realizado
     *
     * @param boolean $realizado
     *
     * @return Cuentasseguimiento
     */
    public function setRealizado($realizado)
    {
        $this->realizado = $realizado;

        return $this;
    }

    /**
     * Get realizado
     *
     * @return boolean
     */
    public function getRealizado()
    {
        return $this->realizado;
    }

    /**
     * Set actual
     *
     * @param boolean $actual
     *
     * @return Cuentasseguimiento
     */
    public function setActual($actual)
    {
        $this->actual = $actual;

        return $this;
    }

    /**
     * Get actual
     *
     * @return boolean
     */
    public function getActual()
    {
        return $this->actual;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Cuentasseguimiento
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
     * @return Cuentasseguimiento
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
     * Set fseguimiento
     *
     * @param \DateTime $fseguimiento
     *
     * @return Cuentasseguimiento
     */
    public function setFseguimiento($fseguimiento)
    {
        $this->fseguimiento = $fseguimiento;

        return $this;
    }

    /**
     * Get fseguimiento
     *
     * @return \DateTime
     */
    public function getFseguimiento()
    {
        return $this->fseguimiento;
    }

    /**
     * Set idcalendario
     *
     * @param \Calendario $idcalendario
     *
     * @return Cuentasseguimiento
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
     * Set idestado
     *
     * @param \Estadosseguimiento $idestado
     *
     * @return Cuentasseguimiento
     */
    public function setIdestado($idestado)
    {
        $this->idestado = $idestado;

        return $this;
    }

    /**
     * Get idestado
     *
     * @return \Estadosseguimiento
     */
    public function getIdestado()
    {
        return $this->idestado;
    }

    /**
     * Set idusuario
     *
     * @param \Usuarios $idusuario
     *
     * @return Cuentasseguimiento
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
     * Set idteleoperador
     *
     * @param \Usuarios $idteleoperador
     *
     * @return Cuentasseguimiento
     */
    public function setIdteleoperador($idteleoperador)
    {
        $this->idteleoperador = $idteleoperador;

        return $this;
    }

    /**
     * Get idteleoperador
     *
     * @return \Usuarios
     */
    public function getIdteleoperador()
    {
        return $this->idteleoperador;
    }

    /**
     * Set idcliente
     *
     * @param \Cuentas $idcliente
     *
     * @return Cuentasseguimiento
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
     * Set codealta
     *
     * @param integer $codealta
     *
     * @return Cuentasseguiminto
     */
    public function setCodealta($codealta)
    {
        $this->codealta = $codealta;

        return $this;
    }

    /**
     * Get codealta
     *
     * @return integer
     */
    public function getCodealta()
    {
        return $this->codealta;
    }
}

