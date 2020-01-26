<?php
namespace Entities;

/**
 * ArgumentarioRespuestas
 *
 * @Table(name="argumentario_respuestas", indexes={@Index(name="argumentario_id", columns={"argumentario_id"})})
 * @Entity
 */
class ArgumentarioRespuestas
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
     * @Column(name="parent_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $parentId;

    /**
     * @var string
     *
     * @Column(name="respuesta", type="string", length=199, precision=0, scale=0, nullable=false, unique=false)
     */
    private $respuesta;

    /**
     * @var \Argumentarios
     *
     * @ManyToOne(targetEntity="Argumentarios")
     * @JoinColumns({
     *   @JoinColumn(name="argumentario_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $argumentario;


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
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return ArgumentarioRespuestas
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set respuesta
     *
     * @param string $respuesta
     *
     * @return ArgumentarioRespuestas
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;

        return $this;
    }

    /**
     * Get respuesta
     *
     * @return string
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set argumentario
     *
     * @param \Argumentarios $argumentario
     *
     * @return ArgumentarioRespuestas
     */
    public function setArgumentario($argumentario)
    {
        $this->argumentario = $argumentario;

        return $this;
    }

    /**
     * Get argumentario
     *
     * @return \Argumentarios
     */
    public function getArgumentario()
    {
        return $this->argumentario;
    }
}

