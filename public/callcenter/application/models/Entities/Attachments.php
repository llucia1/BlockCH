<?php

namespace Entities;

/**
 * Attachments
 *
 * @Table(name="attachments")
 * @Entity
 */
class Attachments
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
     * @var string
     *
     * @Column(name="tableRow", type="string", length=25, precision=0, scale=0, nullable=false, unique=false)
     */
    private $tablerow;

    /**
     * @var string
     *
     * @Column(name="attached", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $attached;

    /**
     * @var string
     *
     * @Column(name="nombreDocumento", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nombredocumento = 'Documento sin nombre';

    /**
     * @var string
     *
     * @Column(name="tipoDocumento", type="string", length=25, precision=0, scale=0, nullable=true, unique=false)
     */
    private $tipodocumento;

    /**
     * @var boolean
     *
     * @Column(name="estado", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @Column(name="fAlta", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $falta;

    public function __construct()
    {
        $this->falta = new \DateTime("now");
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
     * Set idrow
     *
     * @param integer $idrow
     *
     * @return Attachments
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
     * Set tablerow
     *
     * @param string $tablerow
     *
     * @return Attachments
     */
    public function setTablerow($tablerow)
    {
        $this->tablerow = $tablerow;

        return $this;
    }

    /**
     * Get tablerow
     *
     * @return string
     */
    public function getTablerow()
    {
        return $this->tablerow;
    }

    /**
     * Set attached
     *
     * @param string $attached
     *
     * @return Attachments
     */
    public function setAttached($attached)
    {
        $this->attached = $attached;

        return $this;
    }

    /**
     * Get attached
     *
     * @return string
     */
    public function getAttached()
    {
        return $this->attached;
    }

    /**
     * Set nombredocumento
     *
     * @param string $attached
     *
     * @return Attachments
     */
    public function setNombredocumento($nombredocumento)
    {
        $this->nombredocumento = $nombredocumento;

        return $this;
    }

    /**
     * Get nombredocumento
     *
     * @return string
     */
    public function getNombredocumento()
    {
        return $this->nombredocumento;
    }

    /**
     * Set tipodocumento
     *
     * @param string $attached
     *
     * @return Attachments
     */
    public function setTipodocumento($tipodocumento)
    {
        $this->tipodocumento = $tipodocumento;

        return $this;
    }

    /**
     * Get tipodocumento
     *
     * @return string
     */
    public function getTipodocumento()
    {
        return $this->tipodocumento;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Attachments
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
     * @return Cuentas
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
}

