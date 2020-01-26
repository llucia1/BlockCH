<?php

namespace Entities;

/**
 * Carpetas
 *
 * @Table(name="carpetas")
 * @Entity(repositoryClass="Repositories\CarpetasRepositorio")
 */
class Carpetas
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
     * @Column(name="parent", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $parent;

    /**
     * @var string
     *
     * @Column(name="nombre", type="string", length=150, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @Column(name="fCrea", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $fcrea;

    /**
     * @var \DateTime
     *
     * @Column(name="fUpdate", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $fupdate;

    public function __construct()
    {
        $this->fcrea = new \DateTime("now");
        $this->fupdate = new \DateTime("now");
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
     * Set parent
     *
     * @param integer $parent
     *
     * @return Carpetas
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Carpetas
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
     * Set fcrea
     *
     * @param \DateTime $fcrea
     *
     * @return Carpetas
     */
    public function setFcrea($fcrea)
    {
        $this->fcrea = $fcrea;

        return $this;
    }

    /**
     * Get fcrea
     *
     * @return \DateTime
     */
    public function getFcrea()
    {
        return $this->fcrea;
    }

    /**
     * Set fupdate
     *
     * @param \DateTime $fupdate
     *
     * @return Carpetas
     */
    public function setFupdate($fupdate)
    {
        $this->fupdate = $fupdate;

        return $this;
    }

    /**
     * Get fupdate
     *
     * @return \DateTime
     */
    public function getFupdate()
    {
        return $this->fupdate;
    }
}

