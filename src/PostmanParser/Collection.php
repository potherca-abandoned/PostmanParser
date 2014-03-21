<?php


namespace Potherca\PostmanParser;

class Collection extends Item implements PostmanItemCollection
{
//////////////////////////////// CLASS PROPERTIES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    const ATTRIBUTE_FOLDERS = 'folders';
    const ATTRIBUTE_TIMESTAMP = 'timestamp';
    const ATTRIBUTE_SYNCED = 'synced';
    const ATTRIBUTE_REQUESTS = 'requests';

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

    /**
     * @return \Potherca\PostmanParser\Request[]
     */
    public function getRequests()
    {
        $this->requests;
    }

    /**
     * @param array $p_oRequests
s     *
     * @throws \InvalidArgumentException
     */
    public function setRequests(array $p_oRequests)
    {
        foreach ($p_oRequests as $t_sId => $t_oRequest) {
            if ($t_oRequest instanceof Request === false) {
                throw new \InvalidArgumentException('Given array does not contain only Request objects');
            } else {
                $this->requests[$t_sId] = $t_oRequest;
            }
        }
    }

    /**
     * @return boolean
     */
    public function getSynced()
    {
        return $this->synced;
    }

    /**
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

////////////////////////////////// PUBLIC API \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//////////////////////////////// UTILITY METHODS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
}
