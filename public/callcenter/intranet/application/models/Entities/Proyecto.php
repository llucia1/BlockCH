<?php
namespace Entities;

/**
 * Proyecto
 *
 * @Table(name="proyecto")
 * @Entity
 */
class Proyecto
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
     * @Column(name="nombre", type="string", length=150, precision=0, scale=0, nullable=true, unique=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @Column(name="email", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @Column(name="logoLog", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
     */
    private $logolog;

    /**
     * @var string
     *
     * @Column(name="logoPanel", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
     */
    private $logopanel;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Proyecto
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
     * Set email
     *
     * @param string $email
     *
     * @return Proyecto
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
     * Set logolog
     *
     * @param string $logolog
     *
     * @return Proyecto
     */
    public function setLogolog($logolog)
    {
        $this->logolog = $logolog;

        return $this;
    }

    /**
     * Get logolog
     *
     * @return string
     */
    public function getLogolog()
    {
        return $this->logolog;
    }

    /**
     * Set logopanel
     *
     * @param string $logopanel
     *
     * @return Proyecto
     */
    public function setLogopanel($logopanel)
    {
        $this->logopanel = $logopanel;

        return $this;
    }

    /**
     * Get logopanel
     *
     * @return string
     */
    public function getLogopanel()
    {
        return $this->logopanel;
    }
}

