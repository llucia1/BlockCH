<?php

namespace Entities;

/**
 * Useractivity
 *
 * @Table(name="userActivity", indexes={@Index(name="idUsuario", columns={"idUsuario"})})
 * @Entity
 */
class Useractivity
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
     * @Column(name="entity_id", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $entityId;

    /**
     * @var string
     *
     * @Column(name="entity", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $entity;

    /**
     * @var string
     *
     * @Column(name="entity_value", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $entityValue;

    /**
     * @var string
     *
     * @Column(name="entity_state", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $entityState;

    /**
     * @var \DateTime
     *
     * @Column(name="timeCnx", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $timecnx;

    /**
     * @var \DateTime
     *
     * @Column(name="timeOut", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $timeout;

    /**
     * @var \DateTime
     *
     * @Column(name="fActivity", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $factivity;

    /**
     * @var string
     *
     * @Column(name="codeActivity", type="string", length=8, precision=0, scale=0, nullable=true, unique=false)
     */
    private $codeactivity;

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
        $this->factivity = new \DateTime("now");
        $this->codeactivity = date('Ymd');
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
     * Set entityId
     *
     * @param integer $entityId
     *
     * @return Useractivity
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId
     *
     * @return integer
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * Set entity
     *
     * @param string $entity
     *
     * @return Useractivity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity
     *
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set entityValue
     *
     * @param string $entityValue
     *
     * @return Useractivity
     */
    public function setEntityValue($entityValue)
    {
        $this->entityValue = $entityValue;

        return $this;
    }

    /**
     * Get entityValue
     *
     * @return string
     */
    public function getEntityValue()
    {
        return $this->entityValue;
    }

    /**
     * Set entityState
     *
     * @param string $entityState
     *
     * @return Useractivity
     */
    public function setEntityState($entityState)
    {
        $this->entityState = $entityState;

        return $this;
    }

    /**
     * Get entityState
     *
     * @return string
     */
    public function getEntityState()
    {
        return $this->entityState;
    }

    /**
     * Set timecnx
     *
     * @param \DateTime $timecnx
     *
     * @return Useractivity
     */
    public function setTimecnx($timecnx)
    {
        $this->timecnx = $timecnx;

        return $this;
    }

    /**
     * Get timecnx
     *
     * @return \DateTime
     */
    public function getTimecnx()
    {
        return $this->timecnx;
    }

    /**
     * Set timeout
     *
     * @param \DateTime $timeout
     *
     * @return Useractivity
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get timeout
     *
     * @return \DateTime
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set factivity
     *
     * @param \DateTime $factivity
     *
     * @return Useractivity
     */
    public function setFactivity($factivity)
    {
        $this->factivity = $factivity;

        return $this;
    }

    /**
     * Get factivity
     *
     * @return \DateTime
     */
    public function getFactivity()
    {
        return $this->factivity;
    }

    /**
     * Set codeactivity
     *
     * @param string $codeactivity
     *
     * @return Useractivity
     */
    public function setCodeactivity($codeactivity)
    {
        $this->codeactivity = $codeactivity;

        return $this;
    }

    /**
     * Get codeactivity
     *
     * @return string
     */
    public function getCodeactivity()
    {
        return $this->codeactivity;
    }

    /**
     * Set idusuario
     *
     * @param \Usuarios $idusuario
     *
     * @return Useractivity
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

