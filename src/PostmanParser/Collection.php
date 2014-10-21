<?php


namespace Potherca\PostmanParser;

use Potherca\PostmanParser\Items\Folder;
use Potherca\PostmanParser\Items\Item;
use Potherca\PostmanParser\Items\Request;

class Collection extends Item implements PostmanItemCollection
{
    ////////////////////////////// CLASS PROPERTIES \\\\\\\\\\\\\\\\\\\\\\\\\\\\
    const ATTRIBUTE_FOLDERS = 'folders';
    const ATTRIBUTE_TIMESTAMP = 'timestamp';
    const ATTRIBUTE_SYNCED = 'synced';
    const ATTRIBUTE_REQUESTS = 'requests';

    const ERROR_SHOULD_ONLY_CONTAIN_FOLDERS = 'Given array does not contain only Folder objects. ';
    const ERROR_SHOULD_ONLY_CONTAIN_REQUEST = 'Given array does not contain only Request objects';

    /** @var string[] ID of Folder */
    protected $order;
    /** @var Folder[] */
    protected $folders = array();
    /** @var Request[] */
    protected $requests = array();
    /** @var bool */
    protected $synced;
    /** @var int (microseconds) */
    protected $timestamp;

    //////////////////////////// SETTERS AND GETTERS \\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @param \string[] $order
     */
    public function setOrder(array $order)
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
     * @param Request[] $p_oFolders
     *
     * @throws \InvalidArgumentException
     */
    public function setFolders(array $p_oFolders)
    {
        foreach ($p_oFolders as $t_sId => $t_oFolder) {
            if ($t_oFolder instanceof Folder === false) {
                $sType = gettype($t_oFolder);
                $sMessage = sprintf(
                    self::ERROR_SHOULD_ONLY_CONTAIN_FOLDERS . 'Item #%s is of type "%s"',
                    ($t_sId+1),
                    $sType==='object'?get_class($t_oFolder):$sType
                );
                throw new \InvalidArgumentException($sMessage);
            } else {
                $this->folders[$t_sId] = $t_oFolder;
            }
        }
    }

    /**
     * @return Folder[]
     */
    public function getFolders()
    {
        return $this->folders;
    }

    /**
     * @param Request[] $p_oRequests
     *
     * @throws \InvalidArgumentException
     */
    public function setRequests(array $p_oRequests)
    {
        foreach ($p_oRequests as $t_sId => $t_oRequest) {
            if ($t_oRequest instanceof Request === false) {
                $sType = gettype($t_oRequest);
                $sMessage = sprintf(
                    self::ERROR_SHOULD_ONLY_CONTAIN_REQUEST . 'Item #%s is of type "%s"',
                    ($t_sId+1),
                    $sType==='object'?get_class($t_oRequest):$sType
                );
                throw new \InvalidArgumentException($sMessage);
            } else {
                $this->requests[$t_sId] = $t_oRequest;
            }
        }
    }

    /**
     * @return Request[]
     */
    public function getRequests()
    {
        return $this->requests;
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

    //////////////////////////////// PUBLIC API \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    ////////////////////////////// UTILITY METHODS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
}
