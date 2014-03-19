<?php

namespace Potherca\PostmanParser;

abstract class Item implements PostmanItem
{
//////////////////////////////// CLASS PROPERTIES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /** @var string */
    protected $m_sId;
    /** @var string */
    protected $m_sName;
    /** @var string */
    protected $description;

////////////////////////////// SETTERS AND GETTERS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->m_sId = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->m_sId;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->m_sName = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->m_sName;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
