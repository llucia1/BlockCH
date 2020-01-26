<?php
namespace Entities;

/**
 * Reportes
 *
 * @Table(name="reportes", indexes={@Index(name="idUsuario", columns={"idUsuario"})})
 * @Entity
 */
class Reportes
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
     * @Column(name="idRow", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idrow;

    /**
     * @var integer
     *
     * @Column(name="idRowS", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $idrowS = 0;

    /**
     * @var string
     *
     * @Column(name="tabla", type="string", length=25, precision=0, scale=0, nullable=false, unique=false)
     */
    private $tabla;

    /**
     * @var string
     *
     * @Column(name="tablaS", type="string", length=25, precision=0, scale=0, nullable=true, unique=false)
     */
    private $tablas;

    /**
     * @var string
     *
     * @Column(name="comentario", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $comentario;

    /**
     * @var string
     *
     * @Column(name="reporte", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $reporte;

    /**
     * @var \DateTime
     *
     * @Column(name="fReporte", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $freporte;

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
        $this->freporte = new \DateTime("now");
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
     * Set idrow
     *
     * @param integer $idrow
     *
     * @return Reportes
     */
    public function setIdrow($idrow)
    {
        $this->idrow = $idrow;

        return $this;
    }

    /**
     * Get idrow
     *
     * @return integer
     */
    public function getIdrow()
    {
        return $this->idrow;
    }

    /**
     * Set idrowS
     *
     * @param integer $idrowS
     *
     * @return Reportes
     */
    public function setIdrows($idrowS)
    {
        $this->idrowS = $idrowS;

        return $this;
    }

    /**
     * Get idrowS
     *
     * @return integer
     */
    public function getIdrows()
    {
        return $this->idrow;
    }

    /**
     * Set tabla
     *
     * @param string $tabla
     *
     * @return Reportes
     */
    public function setTabla($tabla)
    {
        $this->tabla = $tabla;

        return $this;
    }

    /**
     * Get tabla
     *
     * @return string
     */
    public function getTabla()
    {
        return $this->tabla;
    }

    /**
     * Set tablas
     *
     * @param string $tablas
     *
     * @return Reportes
     */
    public function setTablas($tablas)
    {
        $this->tablas = $tablas;

        return $this;
    }

    /**
     * Get tablas
     *
     * @return string
     */
    public function getTablas()
    {
        return $this->tablas;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     *
     * @return Reportes
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
     * Set reporte
     *
     * @param string $reporte
     *
     * @return Reportes
     */
    public function setReporte($reporte)
    {
        $this->reporte = $reporte;

        return $this;
    }

    /**
     * Get reporte
     *
     * @return string
     */
    public function getReporte()
    {
        return $this->reporte;
    }

    /**
     * Set freporte
     *
     * @param \DateTime $freporte
     *
     * @return Reportes
     */
    public function setFreporte($freporte)
    {
        $this->freporte = $freporte;

        return $this;
    }

    /**
     * Get freporte
     *
     * @return \DateTime
     */
    public function getFreporte()
    {
        return $this->freporte;
    }

    /**
     * Set idusuario
     *
     * @param \Usuarios $idusuario
     *
     * @return Reportes
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

