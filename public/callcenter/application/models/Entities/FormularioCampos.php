<?php

namespace Entities;

/**
 * FormularioCampos
 *
 * @Table(name="formulario_campos", indexes={@Index(name="formulario_id", columns={"formulario_id"})})
 * @Entity(repositoryClass="Repositories\FormularioCamposRepositorio")
 */
class FormularioCampos
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
     * @Column(name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Column(name="type", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     */
    private $type;

    /**
     * @var string
     *
     * @Column(name="options", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $options;

    /**
     * @var integer
     *
     * @Column(name="orderer", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $orderer;

    /**
     * @var \Formularios
     *
     * @ManyToOne(targetEntity="Formularios")
     * @JoinColumns({
     *   @JoinColumn(name="formulario_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $formulario;


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
     * Set name
     *
     * @param string $name
     *
     * @return FormularioCampos
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return FormularioCampos
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set options
     *
     * @param string $options
     *
     * @return FormularioCampos
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set orderer
     *
     * @param integer $orderer
     *
     * @return Registros
     */
    public function setOrderer($orderer)
    {
        $this->orderer = $orderer;

        return $this;
    }

    /**
     * Get orderer
     *
     * @return integer
     */
    public function getOrderer()
    {
        return $this->orderer;
    }

    /**
     * Set formulario
     *
     * @param \Formularios $formulario
     *
     * @return FormularioCampos
     */
    public function setFormulario($formulario)
    {
        $this->formulario = $formulario;

        return $this;
    }

    /**
     * Get formulario
     *
     * @return \Formularios
     */
    public function getFormulario()
    {
        return $this->formulario;
    }
}

