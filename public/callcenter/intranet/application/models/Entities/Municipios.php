<?php

namespace Entities;

/**
 * Municipios
 *
 * @Table(name="municipios", indexes={@Index(name="id_provinca", columns={"id_provincia"})})
 * @Entity
 */
class Municipios
{
    /**
     * @var integer
     *
     * @Column(name="id_municipio", type="smallint", precision=0, scale=0, nullable=false, unique=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idMunicipio;

    /**
     * @var integer
     *
     * @Column(name="cod_municipio", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $codMunicipio;

    /**
     * @var integer
     *
     * @Column(name="DC", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dc;

    /**
     * @var string
     *
     * @Column(name="nombre", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nombre;

    /**
     * @var \Provincias
     *
     * @ManyToOne(targetEntity="Provincias")
     * @JoinColumns({
     *   @JoinColumn(name="id_provincia", referencedColumnName="id_provincia", nullable=true)
     * })
     */
    private $idProvincia;


    /**
     * Get idMunicipio
     *
     * @return integer
     */
    public function getIdMunicipio()
    {
        return $this->idMunicipio;
    }

    /**
     * Set codMunicipio
     *
     * @param integer $codMunicipio
     *
     * @return Municipios
     */
    public function setCodMunicipio($codMunicipio)
    {
        $this->codMunicipio = $codMunicipio;

        return $this;
    }

    /**
     * Get codMunicipio
     *
     * @return integer
     */
    public function getCodMunicipio()
    {
        return $this->codMunicipio;
    }

    /**
     * Set dc
     *
     * @param integer $dc
     *
     * @return Municipios
     */
    public function setDc($dc)
    {
        $this->dc = $dc;

        return $this;
    }

    /**
     * Get dc
     *
     * @return integer
     */
    public function getDc()
    {
        return $this->dc;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Municipios
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
     * Set idProvincia
     *
     * @param \Provincias $idProvincia
     *
     * @return Municipios
     */
    public function setIdProvincia($idProvincia)
    {
        $this->idProvincia = $idProvincia;

        return $this;
    }

    /**
     * Get idProvincia
     *
     * @return \Provincias
     */
    public function getIdProvincia()
    {
        return $this->idProvincia;
    }
}

