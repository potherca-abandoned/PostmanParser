<?php

namespace Potherca\PostmanParser\Items;

use Potherca\PostmanParser\PostmanItem;

abstract class Item implements PostmanItem
{
//////////////////////////////// CLASS PROPERTIES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /** @var string */
    protected $m_sId;
    /** @var string */
    protected $m_sName;
    /** @var string */
    protected $m_sDescription;

////////////////////////////// SETTERS AND GETTERS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @param string $p_sId
     */
    public function setId($p_sId)
    {
        $this->m_sId = $p_sId;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->m_sId;
    }

    /**
     * @param string $p_sName
     */
    public function setName($p_sName)
    {
        $this->m_sName = $p_sName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->m_sName;
    }

    /**
     * @param string $p_sDescription
     */
    public function setDescription($p_sDescription)
    {
        $this->m_sDescription = $p_sDescription;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->m_sDescription;
    }
}
