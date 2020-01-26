<?php
namespace Entities;

/**
 * Equipos
 *
 * @Table(name="equipos", uniqueConstraints={@UniqueConstraint(name="idUsuario", columns={"idUsuario"})}, indexes={@Index(name="idMaster", columns={"idMaster"})})
 * @Entity
 */
class Equipos
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
     * @var \DateTime
     *
     * @Column(name="fAlta", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $falta;

    /**
     * @var \Usuarios
     *
     * @ManyToOne(targetEntity="Usuarios")
     * @JoinColumns({
     *   @JoinColumn(name="idMaster", referencedColumnName="id", nullable=true)
     * })
     */
    private $idmaster;

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
        $this->falta = new \DateTime("now");
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
     * Set falta
     *
     * @param \DateTime $falta
     *
     * @return Equipos
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

    /**
     * Set idmaster
     *
     * @param \Usuarios $idmaster
     *
     * @return Equipos
     */
    public function setIdmaster(\Usuarios $idmaster = null)
    {
        $this->idmaster = $idmaster;

        return $this;
    }

    /**
     * Get idmaster
     *
     * @return \Usuarios
     */
    public function getIdmaster()
    {
        return $this->idmaster;
    }

    /**
     * Set idusuario
     *
     * @param \Usuarios $idusuario
     *
     * @return Equipos
     */
    public function setIdusuario(\Usuarios $idusuario = null)
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

