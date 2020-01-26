<?php
namespace Entities;

/**
 * Registrollamadas
 *
 * @Table(name="registroLlamadas")
 * @Entity
 */
class Registrollamadas
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
     * @var \Registros
     *
     * @ManyToOne(targetEntity="Registros")
     * @JoinColumns({
     *   @JoinColumn(name="idRegistro", referencedColumnName="id", nullable=false)
     * })
     */
    private $idresgistro;

    /**
     * @var \Estadosregistros
     *
     * @ManyToOne(targetEntity="Estadosregistros")
     * @JoinColumns({
     *   @JoinColumn(name="idEstado", referencedColumnName="id", nullable=false)
     * })
     */
    private $idestado;

    /**
     * @var \Usuarios
     *
     * @ManyToOne(targetEntity="Usuarios")
     * @JoinColumns({
     *   @JoinColumn(name="idUsuario", referencedColumnName="id", nullable=false)
     * })
     */
    private $idusuario;

    /**
     * @var \DateTime
     *
     * @Column(name="start", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @Column(name="end", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $end;

    /**
     * @var string
     *
     * @Column(name="comentario", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $comentario;

    public function __construct()
    {
        $this->start = new \DateTime("now");
        $this->idestado = 0;
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
     * Set idresgistro
     *
     * @param integer $idresgistro
     *
     * @return Registrollamadas
     */
    public function setIdregistro($idresgistro)
    {
        $this->idresgistro = $idresgistro;

        return $this;
    }

    /**
     * Get idresgistro
     *
     * @return integer
     */
    public function getIdregistro()
    {
        return $this->idresgistro;
    }

    /**
     * Set idestado
     *
     * @param integer $idestado
     *
     * @return Registrollamadas
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
     * Set idusuario
     *
     * @param integer $idusuario
     *
     * @return Registrollamadas
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get idusuario
     *
     * @return integer
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Registrollamadas
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return Registrollamadas
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     *
     * @return Registrollamadas
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
}

