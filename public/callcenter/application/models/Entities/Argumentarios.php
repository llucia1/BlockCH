<?php
namespace Entities;

/**
 * Argumentarios
 *
 * @Table(name="argumentarios", indexes={@Index(name="campaign_id", columns={"campaign_id"})})
 * @Entity(repositoryClass="Repositories\ArgumentarioRepositorio")
 */
class Argumentarios
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
     * @Column(name="title", type="string", length=199, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

    /**
     * @var string
     *
     * @Column(name="argumentario", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $argumentario;

    /**
     * @var \DateTime
     *
     * @Column(name="create_date", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @Column(name="update_date", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $updateDate;

    /**
     * @var \Campaigns
     *
     * @ManyToOne(targetEntity="Campaigns")
     * @JoinColumns({
     *   @JoinColumn(name="campaign_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $campaign;

    public function __construct()
    {
        $this->createDate = new \DateTime("now");
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
     * Set title
     *
     * @param string $title
     *
     * @return Argumentarios
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set argumentario
     *
     * @param string $argumentario
     *
     * @return Argumentarios
     */
    public function setArgumentario($argumentario)
    {
        $this->argumentario = $argumentario;

        return $this;
    }

    /**
     * Get argumentario
     *
     * @return string
     */
    public function getArgumentario()
    {
        return $this->argumentario;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return Argumentarios
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     *
     * @return Argumentarios
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set campaign
     *
     * @param \Campaigns $campaign
     *
     * @return Argumentarios
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

