<?php

namespace Entities;

/**
 * Registros
 *
 * @Table(name="registros", indexes={@Index(name="fk_re_es", columns={"idEstado"}), @Index(name="idUsuario", columns={"idUsuario"}), @Index(name="campaign_id", columns={"campaign_id"})})
 * @Entity(repositoryClass="Repositories\RegistrosRepositorio")
 */
class Registros
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
     * @Column(name="name", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Column(name="first_name", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @Column(name="last_name", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @Column(name="document_number", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $documentNumber;

    /**
     * @var string
     *
     * @Column(name="modality", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $modality;

    /**
     * @var integer
     *
     * @Column(name="periodicity", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $periodicity;

    /**
     * @var string
     *
     * @Column(name="new_periodicity", type="string", length=10, precision=0, scale=0, nullable=true, unique=false)
     */
    private $newPeriodicity;

    /**
     * @var \DateTime
     *
     * @Column(name="renovation", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $renovation;

    /**
     * @var string
     *
     * @Column(name="checking_account", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $checkingAccount;

    /**
     * @var string
     *
     * @Column(name="prima", type="decimal", precision=10, scale=2, nullable=false, unique=false)
     */
    private $prima;

    /**
     * @var string
     *
     * @Column(name="capital", type="decimal", precision=10, scale=2, nullable=false, unique=false)
     */
    private $capital;

    /**
     * @var integer
     *
     * @Column(name="telephone", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @Column(name="way", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $way;

    /**
     * @var string
     *
     * @Column(name="address", type="string", length=150, precision=0, scale=0, nullable=false, unique=false)
     */
    private $address;

    /**
     * @var integer
     *
     * @Column(name="zip", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $zip;

    /**
     * @var string
     *
     * @Column(name="province", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     */
    private $province;

    /**
     * @var string
     *
     * @Column(name="city", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     */
    private $city;

    /**
     * @var string
     *
     * @Column(name="gender", type="string", length=6, precision=0, scale=0, nullable=false, unique=false)
     */
    private $gender;

    /**
     * @var \DateTime
     *
     * @Column(name="bird_date", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $birdDate;

    /**
     * @var integer
     *
     * @Column(name="age", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $age;

    /**
     * @var string
     *
     * @Column(name="email", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @Column(name="actual_cob", type="string", length=5, precision=0, scale=0, nullable=false, unique=false)
     */
    private $actualCob;

    /**
     * @var string
     *
     * @Column(name="prima_opc1", type="decimal", precision=10, scale=2, nullable=true, unique=false)
     */
    private $primaOpc1;

    /**
     * @var string
     *
     * @Column(name="cob_opc1", type="string", length=5, precision=0, scale=0, nullable=true, unique=false)
     */
    private $cobOpc1;

    /**
     * @var string
     *
     * @Column(name="ahorroeu_opc1", type="decimal", precision=10, scale=2, nullable=true, unique=false)
     */
    private $ahorroeuOpc1;

    /**
     * @var string
     *
     * @Column(name="ahorropercent_opc1", type="decimal", precision=10, scale=2, nullable=true, unique=false)
     */
    private $ahorropercentOpc1;

    /**
     * @var string
     *
     * @Column(name="Prima_opc2", type="decimal", precision=10, scale=2, nullable=true, unique=false)
     */
    private $primaOpc2;

    /**
     * @var string
     *
     * @Column(name="ahorroeu_opc2", type="decimal", precision=10, scale=2, nullable=true, unique=false)
     */
    private $ahorroeuOpc2;

    /**
     * @var string
     *
     * @Column(name="ahorropercent_opc2", type="decimal", precision=10, scale=2, nullable=true, unique=false)
     */
    private $ahorropercentOpc2;

    /**
     * @var boolean
     *
     * @Column(name="oculto", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $oculto;

    /**
     * @var boolean
     *
     * @Column(name="soft_delete", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $softDelete;

    /**
     * @var integer
     *
     * @Column(name="tRegistro", type="decimal", precision=4, scale=2, nullable=true, unique=false)
     */
    private $tregistro;

    /**
     * @var \DateTime
     *
     * @Column(name="fRegistro", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $fregistro;

    /**
     * @var string
     *
     * @Column(name="selec_ries", type="decimal", precision=10, scale=2, nullable=true, unique=false)
     */
    private $selecRies;

    /**
     * @var string
     *
     * @Column(name="reason", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $reason;

    /**
     * @var string
     *
     * @Column(name="lending_number", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $lendingNumber;

    /**
     * @var \Usuarios
     *
     * @ManyToOne(targetEntity="Usuarios")
     * @JoinColumns({
     *   @JoinColumn(name="idUsuario", referencedColumnName="id", nullable=true)
     * })
     */
    private $idusuario;

    /**
     * @var \Estadosregistros
     *
     * @ManyToOne(targetEntity="Estadosregistros")
     * @JoinColumns({
     *   @JoinColumn(name="idEstado", referencedColumnName="id", nullable=true)
     * })
     */
    private $idestado;

    /**
     * @var \Campaigns
     *
     * @ManyToOne(targetEntity="Campaigns")
     * @JoinColumns({
     *   @JoinColumn(name="campaign_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $campaign;

    public function __construct()
    {
        $this->fregistro = new \DateTime("now");
        $this->oculto = 0;
        $this->softDelete = 0;

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
     * Set name
     *
     * @param string $name
     *
     * @return Registros
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Registros
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Registros
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set documentNumber
     *
     * @param string $documentNumber
     *
     * @return Registros
     */
    public function setDocumentNumber($documentNumber)
    {
        $this->documentNumber = $documentNumber;

        return $this;
    }

    /**
     * Get documentNumber
     *
     * @return string
     */
    public function getDocumentNumber()
    {
        return $this->documentNumber;
    }

    /**
     * Set modality
     *
     * @param string $modality
     *
     * @return Registros
     */
    public function setModality($modality)
    {
        $this->modality = $modality;

        return $this;
    }

    /**
     * Get modality
     *
     * @return string
     */
    public function getModality()
    {
        return $this->modality;
    }

    /**
     * Set periodicity
     *
     * @param integer $periodicity
     *
     * @return Registros
     */
    public function setPeriodicity($periodicity)
    {
        $this->periodicity = $periodicity;

        return $this;
    }

    /**
     * Get periodicity
     *
     * @return integer
     */
    public function getPeriodicity()
    {
        return $this->periodicity;
    }

    /**
     * Set newPeriodicity
     *
     * @param string $newPeriodicity
     *
     * @return Registros
     */
    public function setNewPeriodicity($newPeriodicity)
    {
        $this->newPeriodicity = $newPeriodicity;

        return $this;
    }

    /**
     * Get newPeriodicity
     *
     * @return string
     */
    public function getNewPeriodicity()
    {
        return $this->newPeriodicity;
    }

    /**
     * Set renovation
     *
     * @param \DateTime $renovation
     *
     * @return Registros
     */
    public function setRenovation($renovation)
    {
        $this->renovation = $renovation;

        return $this;
    }

    /**
     * Get renovation
     *
     * @return \DateTime
     */
    public function getRenovation()
    {
        return $this->renovation;
    }

    /**
     * Set checkingAccount
     *
     * @param string $checkingAccount
     *
     * @return Registros
     */
    public function setCheckingAccount($checkingAccount)
    {
        $this->checkingAccount = $checkingAccount;

        return $this;
    }

    /**
     * Get checkingAccount
     *
     * @return string
     */
    public function getCheckingAccount()
    {
        return $this->checkingAccount;
    }

    /**
     * Set prima
     *
     * @param string $prima
     *
     * @return Registros
     */
    public function setPrima($prima)
    {
        $this->prima = $prima;

        return $this;
    }

    /**
     * Get prima
     *
     * @return string
     */
    public function getPrima()
    {
        return $this->prima;
    }

    /**
     * Set capital
     *
     * @param string $capital
     *
     * @return Registros
     */
    public function setCapital($capital)
    {
        $this->capital = $capital;

        return $this;
    }

    /**
     * Get capital
     *
     * @return string
     */
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return Registros
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set way
     *
     * @param string $way
     *
     * @return Registros
     */
    public function setWay($way)
    {
        $this->way = $way;

        return $this;
    }

    /**
     * Get way
     *
     * @return string
     */
    public function getWay()
    {
        return $this->way;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Registros
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zip
     *
     * @param integer $zip
     *
     * @return Registros
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return integer
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return Registros
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Registros
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Registros
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birdDate
     *
     * @param \DateTime $birdDate
     *
     * @return Registros
     */
    public function setBirdDate($birdDate)
    {
        $this->birdDate = $birdDate;

        return $this;
    }

    /**
     * Get birdDate
     *
     * @return \DateTime
     */
    public function getBirdDate()
    {
        return $this->birdDate;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Registros
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
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
     * Set actualCob
     *
     * @param string $actualCob
     *
     * @return Registros
     */
    public function setActualCob($actualCob)
    {
        $this->actualCob = $actualCob;

        return $this;
    }

    /**
     * Get actualCob
     *
     * @return string
     */
    public function getActualCob()
    {
        return $this->actualCob;
    }

    /**
     * Set selecRies
     *
     * @param string $selecRies
     *
     * @return Registros
     */
    public function setSelecRies($selecRies)
    {
        $this->selecRies = $selecRies;

        return $this;
    }

    /**
     * Get selecRies
     *
     * @return string
     */
    public function getSelecRies()
    {
        return $this->selecRies;
    }

    /**
     * Set primaOpc1
     *
     * @param string $primaOpc1
     *
     * @return Registros
     */
    public function setPrimaOpc1($primaOpc1)
    {
        $this->primaOpc1 = $primaOpc1;

        return $this;
    }

    /**
     * Get primaOpc1
     *
     * @return string
     */
    public function getPrimaOpc1()
    {
        return $this->primaOpc1;
    }

    /**
     * Set cobOpc1
     *
     * @param string $cobOpc1
     *
     * @return Registros
     */
    public function setCobOpc1($cobOpc1)
    {
        $this->cobOpc1 = $cobOpc1;

        return $this;
    }

    /**
     * Get cobOpc1
     *
     * @return string
     */
    public function getCobOpc1()
    {
        return $this->cobOpc1;
    }

    /**
     * Set lendingNumber
     *
     * @param string $lendingNumber
     *
     * @return Registros
     */
    public function setLendingNumber($lendingNumber)
    {
        $this->lendingNumber = $lendingNumber;

        return $this;
    }

    /**
     * Get lendingNumber
     *
     * @return string
     */
    public function getLendingNumber()
    {
        return $this->lendingNumber;
    }

    /**
     * Set ahorroeuOpc1
     *
     * @param string $ahorroeuOpc1
     *
     * @return Registros
     */
    public function setAhorroeuOpc1($ahorroeuOpc1)
    {
        $this->ahorroeuOpc1 = $ahorroeuOpc1;

        return $this;
    }

    /**
     * Get ahorroeuOpc1
     *
     * @return string
     */
    public function getAhorroeuOpc1()
    {
        return $this->ahorroeuOpc1;
    }

    /**
     * Set ahorropercentOpc1
     *
     * @param string $ahorropercentOpc1
     *
     * @return Registros
     */
    public function setAhorropercentOpc1($ahorropercentOpc1)
    {
        $this->ahorropercentOpc1 = $ahorropercentOpc1;

        return $this;
    }

    /**
     * Get ahorropercentOpc1
     *
     * @return string
     */
    public function getAhorropercentOpc1()
    {
        return $this->ahorropercentOpc1;
    }

    /**
     * Set primaOpc2
     *
     * @param string $primaOpc2
     *
     * @return Registros
     */
    public function setPrimaOpc2($primaOpc2)
    {
        $this->primaOpc2 = $primaOpc2;

        return $this;
    }

    /**
     * Get primaOpc2
     *
     * @return string
     */
    public function getPrimaOpc2()
    {
        return $this->primaOpc2;
    }

    /**
     * Set ahorroeuOpc2
     *
     * @param string $ahorroeuOpc2
     *
     * @return Registros
     */
    public function setAhorroeuOpc2($ahorroeuOpc2)
    {
        $this->ahorroeuOpc2 = $ahorroeuOpc2;

        return $this;
    }

    /**
     * Get ahorroeuOpc2
     *
     * @return string
     */
    public function getAhorroeuOpc2()
    {
        return $this->ahorroeuOpc2;
    }

    /**
     * Set ahorropercentOpc2
     *
     * @param string $ahorropercentOpc2
     *
     * @return Registros
     */
    public function setAhorropercentOpc2($ahorropercentOpc2)
    {
        $this->ahorropercentOpc2 = $ahorropercentOpc2;

        return $this;
    }

    /**
     * Get ahorropercentOpc2
     *
     * @return string
     */
    public function getAhorropercentOpc2()
    {
        return $this->ahorropercentOpc2;
    }

    /**
     * Set oculto
     *
     * @param boolean $oculto
     *
     * @return Registros
     */
    public function setOculto($oculto)
    {
        $this->oculto = $oculto;

        return $this;
    }

    /**
     * Get oculto
     *
     * @return boolean
     */
    public function getOculto()
    {
        return $this->oculto;
    }

    /**
     * Set soft_delete
     *
     * @param boolean $soft_delete
     *
     * @return Registros
     */
    public function setSoftDelete($softDelete)
    {
        $this->softDelete = $softDelete;

        return $this;
    }

    /**
     * Get soft_delete
     *
     * @return boolean
     */
    public function getSoftDelete()
    {
        return $this->softDelete;
    }
    
    /**
     * Set fregistro
     *
     * @param \DateTime $fregistro
     *
     * @return Registros
     */
    public function setFregistro($fregistro)
    {
        $this->fregistro = $fregistro;

        return $this;
    }

    /**
     * Set tregistro
     *
     * @param string $tregistro
     *
     * @return Registros
     */
    public function setTregistro($tregistro)
    {
        $this->tregistro = $tregistro;

        return $this;
    }

    /**
     * Get tregistro
     *
     * @return string
     */
    public function getTregistro()
    {
        return $this->tregistro;
    }

    /**
     * Get fregistro
     *
     * @return \DateTime
     */
    public function getFregistro()
    {
        return $this->fregistro;
    }

    /**
     * Set idusuario
     *
     * @param \Usuarios $idusuario
     *
     * @return Registros
     */
    public function setIdusuario($idusuario)
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

    /**
     * Set idestado
     *
     * @param \Estadosregistros $idestado
     *
     * @return Registros
     */
    public function setIdestado($idestado)
    {
        $this->idestado = $idestado;

        return $this;
    }

    /**
     * Get idestado
     *
     * @return \Estadosregistros
     */
    public function getIdestado()
    {
        return $this->idestado;
    }

    /**
     * Set campaign
     *
     * @param \Campaigns $campaign
     *
     * @return Registros
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

    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return Registros
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }
}

