<?php

namespace Entities;

/**
 * Provincias
 *
 * @Table(name="provincias")
 * @Entity
 */
class Provincias
{
    /**
     * @var integer
     *
     * @Column(name="id_provincia", type="smallint", precision=0, scale=0, nullable=false, unique=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idProvincia;

    /**
     * @var string
     *
     * @Column(name="provincia", type="string", length=30, precision=0, scale=0, nullable=true, unique=false)
     */
    private $provincia;


    /**
     * Get idProvincia
     *
     * @return integer
     */
    public function getIdProvincia()
    {
        return $this->idProvincia;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     *
     * @return Provincias
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
}

