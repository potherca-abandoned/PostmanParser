<?php
namespace Potherca\PostmanParser\Items;

use Potherca\PostmanParser\Enum\DataMode;
use Potherca\PostmanParser\Enum\DescriptionFormat;
use Potherca\PostmanParser\Enum\RequestMethod;
use Potherca\PostmanParser\RequestData;

class Request extends Item
{
//////////////////////////////// CLASS PROPERTIES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /** @var string */
    protected $m_sCollectionId;
    /** @var RequestData[] */
    protected $m_oRequestData;
    /** @var DataMode */
    protected $m_oDataMode;
    /** @var DescriptionFormat */
    protected $m_oDescriptionFormat;
    /** @var string */
    protected $m_sHeaders;
    /** @var RequestMethod */
    protected $m_oRequestMethod;
    /** @var {?} */
    protected $m_uPathVariables;
    /** @var bool */
    protected $m_bSynced;

    /** @var int (microseconds) */
    protected $m_iTime;
    /** @var string */
    protected $m_sUrl;
    /** @var int */
    protected $m_iVersion;

////////////////////////////// SETTERS AND GETTERS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @param int $p_iVersion
     */
    public function setVersion($p_iVersion)
    {
        $this->m_iVersion = $p_iVersion;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->m_iVersion;
    }

    /**
     * @param RequestMethod $p_oMethod
     */
    public function setMethod(/*RequestMethod*/ $p_oMethod)
    {
        $this->m_oRequestMethod = $p_oMethod;
    }

    /**
     * @return RequestMethod
     */
    public function getMethod()
    {
        return $this->m_oRequestMethod;
    }

    /**
     * @param mixed $p_uPathVariables
     */
    public function setPathVariables($p_uPathVariables)
    {
        $this->m_uPathVariables = $p_uPathVariables;
    }

    /**
     * @return mixed
     */
    public function getPathVariables()
    {
        return $this->m_uPathVariables;
    }

    /**
     * @param boolean $p_bSynced
     */
    public function setSynced($p_bSynced)
    {
        $this->m_bSynced = $p_bSynced;
    }

    /**
     * @return boolean
     */
    public function getSynced()
    {
        return $this->m_bSynced;
    }

    /**
     * @param int $p_iTime
     */
    public function setTime($p_iTime)
    {
        $this->m_iTime = $p_iTime;
    }

    /**
     * @return int
     */
    public function getTime()
    {
        return $this->m_iTime;
    }

    /**
     * @param string $p_sUrl
     */
    public function setUrl($p_sUrl)
    {
        $this->m_sUrl = $p_sUrl;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->m_sUrl;
    }

    /**
     * @param string $p_sCollectionId
     */
    public function setCollectionId($p_sCollectionId)
    {
        $this->m_sCollectionId = $p_sCollectionId;
    }

    /**
     * @return string
     */
    public function getCollectionId()
    {
        return $this->m_sCollectionId;
    }

    /**
     * @param RequestData[] $p_oRequestData
     */
    public function setData(Array $p_oRequestData)
    {
        $this->m_oRequestData = $p_oRequestData;
    }

    /**
     * @return RequestData[]
     */
    public function getData()
    {
        return $this->m_oRequestData;
    }

    /**
     * @param DataMode $p_oDataMode
     */
    public function setDataMode(/*DataMode*/ $p_oDataMode)
    {
        $this->m_oDataMode = $p_oDataMode;
    }

    /**
     * @return DataMode
     */
    public function getDataMode()
    {
        return $this->m_oDataMode;
    }

    /**
     * @param DescriptionFormat $p_oDescriptionFormat
     */
    public function setDescriptionFormat(/*DescriptionFormat*/ $p_oDescriptionFormat)
    {
        $this->m_oDescriptionFormat = $p_oDescriptionFormat;
    }

    /**
     * @return DescriptionFormat
     */
    public function getDescriptionFormat()
    {
        return $this->m_oDescriptionFormat;
    }

    /**
     * @param string $p_sHeaders
     */
    public function setHeaders($p_sHeaders)
    {
        $this->m_sHeaders = $p_sHeaders;
    }

    /**
     * @return string
     */
    public function getHeaders()
    {
        return $this->m_sHeaders;
    }

////////////////////////////////// PUBLIC API \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//////////////////////////////// UTILITY METHODS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
}
