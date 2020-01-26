<?php
namespace Entities;

/**
 * Cuentas
 *
 * @Table(name="cuentas", indexes={@Index(name="INDEX", columns={"idUsuario"}), @Index(name="modificado", columns={"modificado"}), @Index(name="idUsuario", columns={"idUsuario"}), @Index(name="idoperador", columns={"idOperador"})})
 * @Entity(repositoryClass="Repositories\CuentasRepositorio")
 */
class Cuentas
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
     * @var integer
     *
     * @Column(name="idComercial", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $idcomercial = 0;

    /**
     * @var string
     *
     * @Column(name="nombre", type="string", length=258, precision=0, scale=0, nullable=true, unique=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @Column(name="numCuenta", type="string", length=20, precision=0, scale=0, nullable=true, unique=false)
     */
    private $numcuenta;

    /**
     * @var integer
     *
     * @Column(name="telefono", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $telefono;

    /**
     * @var integer
     *
     * @Column(name="telefonoAlt", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $telefonoalt;

    /**
     * @var string
     *
     * @Column(name="email", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @Column(name="cif", type="string", length=10, precision=0, scale=0, nullable=true, unique=false)
     */
    private $cif;

    /**
     * @var string
     *
     * @Column(name="personaCnt", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $personacnt;


    /**
     * @var string
     *
     * @Column(name="direccion", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @Column(name="poblacion", type="string", length=35, precision=0, scale=0, nullable=true, unique=false)
     */
    private $poblacion;

    /**
     * @var string
     *
     * @Column(name="provincia", type="string", length=35, precision=0, scale=0, nullable=true, unique=false)
     */
    private $provincia;

    /**
     * @var integer
     *
     * @Column(name="cp", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $cp;

    /**
     * @var string
     *
     * @Column(name="descripcion", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @Column(name="fModificacion", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $fmodificacion;

    /**
     * @var \DateTime
     *
     * @Column(name="fCreacion", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $fcreacion;

    /**
     * @var integer
     *
     * @Column(name="lineasMovil", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $lineasmovil;

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
     * @Column(name="conectaPymes", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $conectapymes;

    /**
     * @var boolean
     *
     * @Column(name="centralita", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $centralita;

    /**
     * @var integer
     *
     * @Column(name="centralitas", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $centralitas;

    /**
     * @var string
     *
     * @Column(name="tipoCpyme", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $tipocpyme;

    /**
     * @var boolean
     *
     * @Column(name="permanencia", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $permanencia;

    /**
     * @var integer
     *
     * @Column(name="tPermanencia", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $tpermanencia;

    /**
     * @var string
     *
     * @Column(name="historial", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $historial;

    /**
     * @var \Operadores
     *
     * @ManyToOne(targetEntity="Operadores")
     * @JoinColumns({
     *   @JoinColumn(name="idOperador", referencedColumnName="id", nullable=true)
     * })
     */
    private $idoperador;

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
     *   @JoinColumn(name="modificado", referencedColumnName="id", nullable=true)
     * })
     */
    private $modificado;

    /**
     * @OneToMany(targetEntity="Cuentasseguimiento", mappedBy="idcliente", cascade={"persist", "remove"})
     * @var Cuentasseguimiento[]
     */
    protected $cuentasSeguimiento;

    public function __construct()
    {
        $this->fcreacion = new \DateTime("now");
        $this->fmodificacion = new \DateTime("now");
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
     * Set idcomercial
     *
     * @param integer $idcomercial
     *
     * @return Cuentas
     */
    public function setIdcomercial($idcomercial)
    {
        $this->idcomercial = $idcomercial;

        return $this;
    }

    /**
     * Get idcomercial
     *
     * @return integer
     */
    public function getIdcomercial()
    {
        return $this->idcomercial;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Cuentas
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
     * Set numcuenta
     *
     * @param string $numcuenta
     *
     * @return Cuentas
     */
    public function setNumcuenta($numcuenta)
    {
        $this->numcuenta = $numcuenta;

        return $this;
    }

    /**
     * Get numcuenta
     *
     * @return string
     */
    public function getNumcuenta()
    {
        return $this->numcuenta;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     *
     * @return Cuentas
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
     * Set telefonoalt
     *
     * @param integer $telefonoalt
     *
     * @return Cuentas
     */
    public function setTelefonoalt($telefonoalt)
    {
        $this->telefonoalt = $telefonoalt;

        return $this;
    }

    /**
     * Get telefonoalt
     *
     * @return integer
     */
    public function getTelefonoalt()
    {
        return $this->telefonoalt;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Cuentas
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set cif
     *
     * @param string $cif
     *
     * @return Cuentas
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
     * Set personacnt
     *
     * @param string $personacnt
     *
     * @return Cuentas
     */
    public function setPersonacnt($personacnt)
    {
        $this->personacnt = $personacnt;

        return $this;
    }

    /**
     * Get personacnt
     *
     * @return string
     */
    public function getPersonacnt()
    {
        return $this->personacnt;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Cuentas
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set poblacion
     *
     * @param string $poblacion
     *
     * @return Cuentas
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
     * Set provincia
     *
     * @param string $provincia
     *
     * @return Cuentas
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set cp
     *
     * @param integer $cp
     *
     * @return Cuentas
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Cuentas
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set historial
     *
     * @param string $historial
     *
     * @return Cuentas
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
     * Set fmodificacion
     *
     * @param \DateTime $fmodificacion
     *
     * @return Cuentas
     */
    public function setFmodificacion($fmodificacion)
    {
        $this->fmodificacion = $fmodificacion;

        return $this;
    }

    /**
     * Get fmodificacion
     *
     * @return \DateTime
     */
    public function getFmodificacion()
    {
        return $this->fmodificacion;
    }

    /**
     * Set fcreacion
     *
     * @param \DateTime $fcreacion
     *
     * @return Cuentas
     */
    public function setFcreacion($fcreacion)
    {
        $this->fcreacion = $fcreacion;

        return $this;
    }

    /**
     * Get fcreacion
     *
     * @return \DateTime
     */
    public function getFcreacion()
    {
        return $this->fcreacion;
    }

    /**
     * Set lineasmovil
     *
     * @param integer $lineasmovil
     *
     * @return Cuentas
     */
    public function setLineasmovil($lineasmovil)
    {
        $this->lineasmovil = $lineasmovil;

        return $this;
    }

    /**
     * Get lineasmovil
     *
     * @return integer
     */
    public function getLineasmovil()
    {
        return $this->lineasmovil;
    }

    /**
     * Set lineasdatos
     *
     * @param integer $lineasdatos
     *
     * @return Cuentas
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
     * @return Cuentas
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
     * Set conectapymes
     *
     * @param integer $conectapymes
     *
     * @return Cuentas
     */
    public function setConectapymes($conectapymes)
    {
        $this->conectapymes = $conectapymes;

        return $this;
    }

    /**
     * Get conectapymes
     *
     * @return integer
     */
    public function getConectapymes()
    {
        return $this->conectapymes;
    }

    /**
     * Set centralita
     *
     * @param boolean $centralita
     *
     * @return Cuentas
     */
    public function setCentralita($centralita)
    {
        $this->centralita = $centralita;

        return $this;
    }

    /**
     * Get centralita
     *
     * @return boolean
     */
    public function getCentralita()
    {
        return $this->centralita;
    }

    /**
     * Set centralitas
     *
     * @param integer $centralitas
     *
     * @return Cuentas
     */
    public function setCentralitas($centralitas)
    {
        $this->centralitas = $centralitas;

        return $this;
    }

    /**
     * Get centralitas
     *
     * @return integer
     */
    public function getCentralitas()
    {
        return $this->centralitas;
    }

    /**
     * Set tipocpyme
     *
     * @param string $tipocpyme
     *
     * @return Cuentas
     */
    public function setTipocpyme($tipocpyme)
    {
        $this->tipocpyme = $tipocpyme;

        return $this;
    }

    /**
     * Get tipocpyme
     *
     * @return string
     */
    public function getTipocpyme()
    {
        return $this->tipocpyme;
    }

    /**
     * Set permanencia
     *
     * @param boolean $permanencia
     *
     * @return Cuentas
     */
    public function setPermanencia($permanencia)
    {
        $this->permanencia = $permanencia;

        return $this;
    }

    /**
     * Get permanencia
     *
     * @return boolean
     */
    public function getPermanencia()
    {
        return $this->permanencia;
    }

    /**
     * Set tpermanencia
     *
     * @param integer $tpermanencia
     *
     * @return Cuentas
     */
    public function setTpermanencia($tpermanencia)
    {
        $this->tpermanencia = $tpermanencia;

        return $this;
    }

    /**
     * Get tpermanencia
     *
     * @return integer
     */
    public function getTpermanencia()
    {
        return $this->tpermanencia;
    }

    /**
     * Set idoperador
     *
     * @param \Operadores $idoperador
     *
     * @return Cuentas
     */
    public function setIdoperador($idoperador)
    {
        $this->idoperador = $idoperador;

        return $this;
    }

    /**
     * Get idoperador
     *
     * @return \Operadores
     */
    public function getIdoperador()
    {
        return $this->idoperador;
    }

    /**
     * Set idusuario
     *
     * @param \Usuarios $idusuario
     *
     * @return Cuentas
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
     * Set modificado
     *
     * @param \Usuarios $modificado
     *
     * @return Cuentas
     */
    public function setModificado($modificado)
    {
        $this->modificado = $modificado;

        return $this;
    }

    /**
     * Get modificado
     *
     * @return \Usuarios
     */
    public function getModificado()
    {
        return $this->modificado;
    }

    /**
     * @return array
     */
    public function getCuentasseguimiento()
    {
        return $this->cuentasSeguimiento->toArray();
    }
}

