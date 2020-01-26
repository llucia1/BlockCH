<?php
namespace Entities;

/**
 * Roles
 *
 * @Table(name="roles")
 * @Entity
 */
class Roles
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
     * @Column(name="rol", type="string", length=35, precision=0, scale=0, nullable=true, unique=false)
     */
    private $rol;

    /**
     * @var string
     *
     * @Column(name="permisos", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $permisos;


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
     * Set rol
     *
     * @param string $rol
     *
     * @return Roles
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return string
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set permisos
     *
     * @param string $permisos
     *
     * @return Roles
     */
    public function setPermisos($permisos)
    {
        $this->permisos = $permisos;

        return $this;
    }

    /**
     * Get permisos
     *
     * @return string
     */
    public function getPermisos()
    {
        return $this->permisos;
    }
}

