<?php


namespace Potherca\PostmanParser\Items;

use Potherca\PostmanParser\PostmanItemCollection;

class Folder extends Item implements PostmanItemCollection
{
    ////////////////////////////// CLASS PROPERTIES \\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /** @var string[] ID of Request */
    protected $m_aOrder;
    /** @var string */
    protected $m_sCollectionId;
    /** @var string */
    protected $m_sCollectionName;

    //////////////////////////// SETTERS AND GETTERS \\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @param \string[] $p_aOrder
     */
    public function setOrder(array $p_aOrder)
    {
        $this->m_aOrder = $p_aOrder;
    }

    /**
     * @return \string[]
     */
    public function getOrder()
    {
        return $this->m_aOrder;
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
     * @param string $p_sCollectionName
     */
    public function setCollectionName($p_sCollectionName)
    {
        $this->m_sCollectionName = $p_sCollectionName;
    }

    /**
     * @return string
     */
    public function getCollectionName()
    {
        return $this->m_sCollectionName;
    }

    //////////////////////////////// PUBLIC API \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    ////////////////////////////// UTILITY METHODS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
}
