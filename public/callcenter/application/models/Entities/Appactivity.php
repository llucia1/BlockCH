<?php
namespace Entities;

/**
 * Appactivity
 *
 * @Table(name="appActivity")
 * @Entity
 */
class Appactivity
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
     * @Column(name="idRel", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $idrel;

    /**
     * @var string
     *
     * @Column(name="tabla", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $tabla;

    /**
     * @var integer
     *
     * @Column(name="idEstado", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $idestado;

    /**
     * @var \DateTime
     *
     * @Column(name="fRegistro", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $fregistro;

    /**
     * @var \DateTime
     *
     * @Column(name="fEstado", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $festado;

    /**
     * @var \DateTime
     *
     * @Column(name="fUltimaActualizacion", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $fultimaactualizacion;


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
     * Set idrel
     *
     * @param integer $idrel
     *
     * @return Appactivity
     */
    public function setIdrel($idrel)
    {
        $this->idrel = $idrel;

        return $this;
    }

    /**
     * Get idrel
     *
     * @return integer
     */
    public function getIdrel()
    {
        return $this->idrel;
    }

    /**
     * Set tabla
     *
     * @param string $tabla
     *
     * @return Appactivity
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
     * Set idestado
     *
     * @param integer $idestado
     *
     * @return Appactivity
     */
    public function setIdestado($idestado)
    {
        $this->idestado = $idestado;

        return $this;
    }

    /**
     * Get idestado
     *
     * @return integer
     */
    public function getIdestado()
    {
        return $this->idestado;
    }

    /**
     * Set fregistro
     *
     * @param \DateTime $fregistro
     *
     * @return Appactivity
     */
    public function setFregistro($fregistro)
    {
        $this->fregistro = $fregistro;

        return $this;
    }

    /**
     * Get fregistro
     *
     * @return \DateTime
     */
    public function getFregistro()
    {
        return $this->fregistro;
    }

    /**
     * Set festado
     *
     * @param \DateTime $festado
     *
     * @return Appactivity
     */
    public function setFestado($festado)
    {
        $this->festado = $festado;

        return $this;
    }

    /**
     * Get festado
     *
     * @return \DateTime
     */
    public function getFestado()
    {
        return $this->festado;
    }

    /**
     * Set fultimaactualizacion
     *
     * @param \DateTime $fultimaactualizacion
     *
     * @return Appactivity
     */
    public function setFultimaactualizacion($fultimaactualizacion)
    {
        $this->fultimaactualizacion = $fultimaactualizacion;

        return $this;
    }

    /**
     * Get fultimaactualizacion
     *
     * @return \DateTime
     */
    public function getFultimaactualizacion()
    {
        return $this->fultimaactualizacion;
    }
}

