<?php


namespace Potherca\PostmanParser;

class Collection extends Item implements PostmanCollection
{
//////////////////////////////// CLASS PROPERTIES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /** @var string[] ID of Folder */
    protected $order;

    /** @var Folder[] */
    protected $folders;
    /** @var Request[] */
    protected $requests;
    /** @var bool */
    protected $synced;
    /** @var int (microseconds) */
    protected $timestamp;

////////////////////////////// SETTERS AND GETTERS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @param \string[] $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return \string[]
     */
    public function getOrder()
    {
        return $this->order;
    }
////////////////////////////////// PUBLIC API \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//////////////////////////////// UTILITY METHODS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
}
