<?php

namespace Entities;

/**
 * Formularios
 *
 * @Table(name="formularios", indexes={@Index(name="campaign", columns={"campaign_id"})})
 * @Entity
 */
class Formularios
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
     * @Column(name="name", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var \Campaigns
     *
     * @ManyToOne(targetEntity="Campaigns")
     * @JoinColumns({
     *   @JoinColumn(name="campaign_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $campaign;


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
     * Set name
     *
     * @param string $name
     *
     * @return Formularios
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set campaign
     *
     * @param \Campaigns $campaign
     *
     * @return Formularios
     */
    public function setCampaign($campaign)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Get campaign
     *
     * @return \Campaigns
     */
    public function getCampaign()
    {
        return $this->campaign;
    }
}

