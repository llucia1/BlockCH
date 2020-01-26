<?php
namespace Entities;

/**
 * Menupanel
 *
 * @Table(name="menuPanel")
 * @Entity(repositoryClass="Repositories\MenupanelRepositorio")
 */
class Menupanel
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
     * @Column(name="nombre", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @Column(name="parent", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $parent;

    /**
     * @var string
     *
     * @Column(name="icono", type="string", length=30, precision=0, scale=0, nullable=true, unique=false)
     */
    private $icono;

    /**
     * @var boolean
     *
     * @Column(name="visible", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $visible;

    /**
     * @var integer
     *
     * @Column(name="nivel", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $nivel;

    /**
     * @var integer
     *
     * @Column(name="peso", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $peso;


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
     * @return Menupanel
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
     * Set parent
     *
     * @param integer $parent
     *
     * @return Menupanel
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
     * Set icono
     *
     * @param string $icono
     *
     * @return Menupanel
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;

        return $this;
    }

    /**
     * Get icono
     *
     * @return string
     */
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return Menupanel
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set nivel
     *
     * @param integer $nivel
     *
     * @return Menupanel
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return integer
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set peso
     *
     * @param integer $peso
     *
     * @return Menupanel
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return integer
     */
    public function getPeso()
    {
        return $this->peso;
    }
}

