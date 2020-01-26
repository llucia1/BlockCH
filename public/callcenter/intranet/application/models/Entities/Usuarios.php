<?php
namespace Entities;

/**
 * Usuarios
 *
 * @Table(name="usuarios", indexes={@Index(name="fk_us_rol", columns={"idRol"})})
 * @Entity(repositoryClass="Repositories\UsuariosRepositorio")
 */
class Usuarios
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
     * @Column(name="nombre", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @Column(name="apellidos", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @Column(name="img", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $img;

    /**
     * @var \DateTime
     *
     * @Column(name="fNacimiento", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $fnacimiento;

    /**
     * @var string
     *
     * @Column(name="email", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @Column(name="pass", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $pass;

    /**
     * @var boolean
     *
     * @Column(name="estado", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @Column(name="color", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $color;

    /**
     * @var \Roles
     *
     * @ManyToOne(targetEntity="Roles")
     * @JoinColumns({
     *   @JoinColumn(name="idRol", referencedColumnName="id", nullable=true)
     * })
     */
    private $idrol;

    /**
     * @OneToMany(targetEntity="Equipos", mappedBy="idmaster", cascade={"persist", "remove"})
     * @var equipo[]
     */
    protected $equipo;


    public function __construct()
    {
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Usuarios
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
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Usuarios
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return Usuarios
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set fnacimiento
     *
     * @param \DateTime $fnacimiento
     *
     * @return Usuarios
     */
    public function setFnacimiento($fnacimiento)
    {
        $this->fnacimiento = $fnacimiento;

        return $this;
    }

    /**
     * Get fnacimiento
     *
     * @return \DateTime
     */
    public function getFnacimiento()
    {
        return $this->fnacimiento;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Usuarios
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
     * Set pass
     *
     * @param string $pass
     *
     * @return Usuarios
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Usuarios
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
     * Set idrol
     *
     * @param \Roles $idrol
     *
     * @return Usuarios
     */
    public function setIdrol($idrol)
    {
        $this->idrol = $idrol;

        return $this;
    }

    /**
     * Get idrol
     *
     * @return \Roles
     */
    public function getIdrol()
    {
        return $this->idrol;
    }

     /**
     * Set color
     *
     * @param string $color
     *
     * @return Usuarios
     */
     public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return array
     */
    public function getEquipo()
    {
        return $this->equipo->toArray();
    }

}

