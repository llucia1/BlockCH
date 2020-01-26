<?php
namespace Entities;

/**
 * Oportunidades
 *
 * @Table(name="oportunidades", indexes={@Index(name="idCuenta", columns={"idCuenta"}), @Index(name="idFaseVenta", columns={"idFaseVenta"}), @Index(name="idUsuario", columns={"idUsuario"})})
 * @Entity(repositoryClass="Repositories\OportunidadesRepositorio")
 */
class Oportunidades
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
     * @Column(name="nombre", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @Column(name="cif", type="string", length=10, precision=0, scale=0, nullable=true, unique=false)
     */
    private $cif;

    /**
     * @var integer
     *
     * @Column(name="cp", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $cp;

    /**
     * @var string
     *
     * @Column(name="poblacion", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $poblacion;

    /**
     * @var string
     *
     * @Column(name="operadora", type="string", length=25, precision=0, scale=0, nullable=true, unique=false)
     */
    private $operadora;

    /**
     * @var integer
     *
     * @Column(name="lineasMoviles", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $lineasmoviles;

    /**
     * @var integer
     *
     * @Column(name="lineasDatos", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $lineasdatos;

    /**
     * @var integer
     *
     * @Column(name="adsl", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $adsl;

    /**
     * @var integer
     *
     * @Column(name="conectaPyme", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $conectapyme;

    /**
     * @var string
     *
     * @Column(name="historial", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $historial;

    /**
     * @var string
     *
     * @Column(name="Teleoperadora", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $teleoperadora;

    /**
     * @var boolean
     *
     * @Column(name="facturaCRM", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $facturacrm;

    /**
     * @var \DateTime
     *
     * @Column(name="fecFactura", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $fecfactura;

    /**
     * @var \DateTime
     *
     * @Column(name="presupuestoCrm", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $presupuestocrm;

    /**
     * @var \DateTime
     *
     * @Column(name="coberturaCrm", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $coberturacrm;

    /**
     * @var boolean
     *
     * @Column(name="preEntrCliente", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $preentrcliente;

    /**
     * @var \DateTime
     *
     * @Column(name="citaEntrPresupuesto", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $citaentrpresupuesto;

    /**
     * @var \DateTime
     *
     * @Column(name="fecProxLlamada", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $fecproxllamada;

    /**
     * @var \DateTime
     *
     * @Column(name="fechaCita", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $fechacita;

    /**
     * @var string
     *
     * @Column(name="tarea", type="string", length=150, precision=0, scale=0, nullable=true, unique=false)
     */
    private $tarea;

    /**
     * @var \DateTime
     *
     * @Column(name="n2", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $n2;

    /**
     * @var \DateTime
     *
     * @Column(name="n3", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $n3;

    /**
     * @var \DateTime
     *
     * @Column(name="oferta2", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $oferta2;

    /**
     * @var \DateTime
     *
     * @Column(name="oferta3", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $oferta3;

    /**
     * @var \DateTime
     *
     * @Column(name="cierra", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $cierra;

    /**
     * @var \DateTime
     *
     * @Column(name="fechaKo", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $fechako;

    /**
     * @var boolean
     *
     * @Column(name="converg", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $converg;

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
     * @var \Cuentas
     *
     * @ManyToOne(targetEntity="Cuentas")
     * @JoinColumns({
     *   @JoinColumn(name="idCuenta", referencedColumnName="id", nullable=true)
     * })
     */
    private $idcuenta;

    /**
     * @var \Faseventas
     *
     * @ManyToOne(targetEntity="Faseventas")
     * @JoinColumns({
     *   @JoinColumn(name="idFaseVenta", referencedColumnName="id", nullable=true)
     * })
     */
    private $idfaseventa;

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
     * @return Oportunidades
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
     * Set cif
     *
     * @param string $cif
     *
     * @return Oportunidades
     */
    public function setCif($cif)
    {
        $this->cif = $cif;

        return $this;
    }

    /**
     * Get cif
     *
     * @return string
     */
    public function getCif()
    {
        return $this->cif;
    }

    /**
     * Set cp
     *
     * @param integer $cp
     *
     * @return Oportunidades
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
     * Set poblacion
     *
     * @param string $poblacion
     *
     * @return Oportunidades
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
     * Set operadora
     *
     * @param string $operadora
     *
     * @return Oportunidades
     */
    public function setOperadora($operadora)
    {
        $this->operadora = $operadora;

        return $this;
    }

    /**
     * Get operadora
     *
     * @return string
     */
    public function getOperadora()
    {
        return $this->operadora;
    }

    /**
     * Set lineasmoviles
     *
     * @param integer $lineasmoviles
     *
     * @return Oportunidades
     */
    public function setLineasmoviles($lineasmoviles)
    {
        $this->lineasmoviles = $lineasmoviles;

        return $this;
    }

    /**
     * Get lineasmoviles
     *
     * @return integer
     */
    public function getLineasmoviles()
    {
        return $this->lineasmoviles;
    }

    /**
     * Set lineasdatos
     *
     * @param integer $lineasdatos
     *
     * @return Oportunidades
     */
    public function setLineasdatos($lineasdatos)
    {
        $this->lineasdatos = $lineasdatos;

        return $this;
    }

    /**
     * Get lineasdatos
     *
     * @return integer
     */
    public function getLineasdatos()
    {
        return $this->lineasdatos;
    }

    /**
     * Set adsl
     *
     * @param integer $adsl
     *
     * @return Oportunidades
     */
    public function setAdsl($adsl)
    {
        $this->adsl = $adsl;

        return $this;
    }

    /**
     * Get adsl
     *
     * @return integer
     */
    public function getAdsl()
    {
        return $this->adsl;
    }

    /**
     * Set conectapyme
     *
     * @param integer $conectapyme
     *
     * @return Oportunidades
     */
    public function setConectapyme($conectapyme)
    {
        $this->conectapyme = $conectapyme;

        return $this;
    }

    /**
     * Get conectapyme
     *
     * @return integer
     */
    public function getConectapyme()
    {
        return $this->conectapyme;
    }

    /**
     * Set historial
     *
     * @param string $historial
     *
     * @return Oportunidades
     */
    public function setHistorial($historial)
    {
        $this->historial = $historial;

        return $this;
    }

    /**
     * Get historial
     *
     * @return string
     */
    public function getHistorial()
    {
        return $this->historial;
    }

    /**
     * Set teleoperadora
     *
     * @param string $teleoperadora
     *
     * @return Oportunidades
     */
    public function setTeleoperadora($teleoperadora)
    {
        $this->teleoperadora = $teleoperadora;

        return $this;
    }

    /**
     * Get teleoperadora
     *
     * @return string
     */
    public function getTeleoperadora()
    {
        return $this->teleoperadora;
    }

    /**
     * Set facturacrm
     *
     * @param boolean $facturacrm
     *
     * @return Oportunidades
     */
    public function setFacturacrm($facturacrm)
    {
        $this->facturacrm = $facturacrm;

        return $this;
    }

    /**
     * Get facturacrm
     *
     * @return boolean
     */
    public function getFacturacrm()
    {
        return $this->facturacrm;
    }

    /**
     * Set fecfactura
     *
     * @param \DateTime $fecfactura
     *
     * @return Oportunidades
     */
    public function setFecfactura($fecfactura)
    {
        $this->fecfactura = $fecfactura;

        return $this;
    }

    /**
     * Get fecfactura
     *
     * @return \DateTime
     */
    public function getFecfactura()
    {
        return $this->fecfactura;
    }

    /**
     * Set presupuestocrm
     *
     * @param \DateTime $presupuestocrm
     *
     * @return Oportunidades
     */
    public function setPresupuestocrm($presupuestocrm)
    {
        $this->presupuestocrm = $presupuestocrm;

        return $this;
    }

    /**
     * Get presupuestocrm
     *
     * @return \DateTime
     */
    public function getPresupuestocrm()
    {
        return $this->presupuestocrm;
    }

    /**
     * Set coberturacrm
     *
     * @param \DateTime $coberturacrm
     *
     * @return Oportunidades
     */
    public function setCoberturacrm($coberturacrm)
    {
        $this->coberturacrm = $coberturacrm;

        return $this;
    }

    /**
     * Get coberturacrm
     *
     * @return \DateTime
     */
    public function getCoberturacrm()
    {
        return $this->coberturacrm;
    }

    /**
     * Set preentrcliente
     *
     * @param boolean $preentrcliente
     *
     * @return Oportunidades
     */
    public function setPreentrcliente($preentrcliente)
    {
        $this->preentrcliente = $preentrcliente;

        return $this;
    }

    /**
     * Get preentrcliente
     *
     * @return boolean
     */
    public function getPreentrcliente()
    {
        return $this->preentrcliente;
    }

    /**
     * Set citaentrpresupuesto
     *
     * @param \DateTime $citaentrpresupuesto
     *
     * @return Oportunidades
     */
    public function setCitaentrpresupuesto($citaentrpresupuesto)
    {
        $this->citaentrpresupuesto = $citaentrpresupuesto;

        return $this;
    }

    /**
     * Get citaentrpresupuesto
     *
     * @return \DateTime
     */
    public function getCitaentrpresupuesto()
    {
        return $this->citaentrpresupuesto;
    }

    /**
     * Set fecproxllamada
     *
     * @param \DateTime $fecproxllamada
     *
     * @return Oportunidades
     */
    public function setFecproxllamada($fecproxllamada)
    {
        $this->fecproxllamada = $fecproxllamada;

        return $this;
    }

    /**
     * Get fecproxllamada
     *
     * @return \DateTime
     */
    public function getFecproxllamada()
    {
        return $this->fecproxllamada;
    }

    /**
     * Set fechacita
     *
     * @param \DateTime $fechacita
     *
     * @return Oportunidades
     */
    public function setFechacita($fechacita)
    {
        $this->fechacita = $fechacita;

        return $this;
    }

    /**
     * Get fechacita
     *
     * @return \DateTime
     */
    public function getFechacita()
    {
        return $this->fechacita;
    }

    /**
     * Set tarea
     *
     * @param string $tarea
     *
     * @return Oportunidades
     */
    public function setTarea($tarea)
    {
        $this->tarea = $tarea;

        return $this;
    }

    /**
     * Get tarea
     *
     * @return string
     */
    public function getTarea()
    {
        return $this->tarea;
    }

    /**
     * Set n2
     *
     * @param \DateTime $n2
     *
     * @return Oportunidades
     */
    public function setN2($n2)
    {
        $this->n2 = $n2;

        return $this;
    }

    /**
     * Get n2
     *
     * @return \DateTime
     */
    public function getN2()
    {
        return $this->n2;
    }

    /**
     * Set n3
     *
     * @param \DateTime $n3
     *
     * @return Oportunidades
     */
    public function setN3($n3)
    {
        $this->n3 = $n3;

        return $this;
    }

    /**
     * Get n3
     *
     * @return \DateTime
     */
    public function getN3()
    {
        return $this->n3;
    }

    /**
     * Set oferta2
     *
     * @param \DateTime $oferta2
     *
     * @return Oportunidades
     */
    public function setOferta2($oferta2)
    {
        $this->oferta2 = $oferta2;

        return $this;
    }

    /**
     * Get oferta2
     *
     * @return \DateTime
     */
    public function getOferta2()
    {
        return $this->oferta2;
    }

    /**
     * Set oferta3
     *
     * @param \DateTime $oferta3
     *
     * @return Oportunidades
     */
    public function setOferta3($oferta3)
    {
        $this->oferta3 = $oferta3;

        return $this;
    }

    /**
     * Get oferta3
     *
     * @return \DateTime
     */
    public function getOferta3()
    {
        return $this->oferta3;
    }

    /**
     * Set cierra
     *
     * @param \DateTime $cierra
     *
     * @return Oportunidades
     */
    public function setCierra($cierra)
    {
        $this->cierra = $cierra;

        return $this;
    }

    /**
     * Get cierra
     *
     * @return \DateTime
     */
    public function getCierra()
    {
        return $this->cierra;
    }

    /**
     * Set fechako
     *
     * @param \DateTime $fechako
     *
     * @return Oportunidades
     */
    public function setFechako($fechako)
    {
        $this->fechako = $fechako;

        return $this;
    }

    /**
     * Get fechako
     *
     * @return \DateTime
     */
    public function getFechako()
    {
        return $this->fechako;
    }

    /**
     * Set converg
     *
     * @param boolean $converg
     *
     * @return Oportunidades
     */
    public function setConverg($converg)
    {
        $this->converg = $converg;

        return $this;
    }

    /**
     * Get converg
     *
     * @return boolean
     */
    public function getConverg()
    {
        return $this->converg;
    }

    /**
     * Set idusuario
     *
     * @param \Usuarios $idusuario
     *
     * @return Oportunidades
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
     * Set idcuenta
     *
     * @param \Cuentas $idcuenta
     *
     * @return Oportunidades
     */
    public function setIdcuenta($idcuenta)
    {
        $this->idcuenta = $idcuenta;

        return $this;
    }

    /**
     * Get idcuenta
     *
     * @return \Cuentas
     */
    public function getIdcuenta()
    {
        return $this->idcuenta;
    }

    /**
     * Set idfaseventa
     *
     * @param \Faseventas $idfaseventa
     *
     * @return Oportunidades
     */
    public function setIdfaseventa($idfaseventa)
    {
        $this->idfaseventa = $idfaseventa;

        return $this;
    }

    /**
     * Get idfaseventa
     *
     * @return \Faseventas
     */
    public function getIdfaseventa()
    {
        return $this->idfaseventa;
    }
}

