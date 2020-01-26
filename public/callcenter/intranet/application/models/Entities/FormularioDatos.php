<?php
namespace Entities;

/**
 * FormularioDatos
 *
 * @Table(name="formulario_datos")
 * @Entity
 */
class FormularioDatos
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
     * @Column(name="row_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $rowId;

    /**
     * @var string
     *
     * @Column(name="row_table", type="string", length=150, precision=0, scale=0, nullable=false, unique=false)
     */
    private $rowTable;

    /**
     * @var string
     *
     * @Column(name="traza", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $traza;


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
     * Set rowId
     *
     * @param integer $rowId
     *
     * @return FormularioDatos
     */
    public function setRowId($rowId)
    {
        $this->rowId = $rowId;

        return $this;
    }

    /**
     * Get rowId
     *
     * @return integer
     */
    public function getRowId()
    {
        return $this->rowId;
    }

    /**
     * Set rowTable
     *
     * @param string $rowTable
     *
     * @return FormularioDatos
     */
    public function setRowTable($rowTable)
    {
        $this->rowTable = $rowTable;

        return $this;
    }

    /**
     * Get rowTable
     *
     * @return string
     */
    public function getRowTable()
    {
        return $this->rowTable;
    }

    /**
     * Set traza
     *
     * @param string $traza
     *
     * @return FormularioDatos
     */
    public function setTraza($traza)
    {
        $this->traza = $traza;

        return $this;
    }

    /**
     * Get traza
     *
     * @return string
     */
    public function getTraza()
    {
        return $this->traza;
    }
}

