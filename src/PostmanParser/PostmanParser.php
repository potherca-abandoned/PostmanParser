<?php

namespace Potherca\PostmanParser;

class PostmanParser
{
    const ERROR_JSON_DOES_NOT_REPRESENT_POSTMAN_COLLECTION = 'Given Json does not represent a valid Postman JSON Collection';
    /** @var string */
    protected $originalJson;
//////////////////////////////// CLASS PROPERTIES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @return string
     */
    protected function getOriginalJson()
    {
        return $this->originalJson;
    }

    /**
     * @param string $originalJson
     */
    protected function setOriginalJson($originalJson)
    {
        $this->originalJson = (string) $originalJson;
    }
////////////////////////////// SETTERS AND GETTERS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\

////////////////////////////////// PUBLIC API \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

    public function parse($p_sPostmanJson)
    {
        if($this->isValid($p_sPostmanJson) === false){
            throw new \InvalidArgumentException(self::ERROR_JSON_DOES_NOT_REPRESENT_POSTMAN_COLLECTION);
        } else {
            $oCollection = new Collection();
            return $oCollection;
        }
    }

    /**
     * @param \SplFileObject $oFile
     *
     * @return Collection
     */
    public function collectionFromFile(\SplFileObject $oFile)
    {
        $sContent = '';

        foreach ($oFile as $t_sLine) {
            $sContent .= $t_sLine;
        }

        return $this->parse($sContent);
    }

//////////////////////////////// UTILITY METHODS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @param string $p_sPostmanJson
     *
     * @return bool
     */
    protected function isValid($p_sPostmanJson)
    {
        $bIsValid = false;

        if(is_string($p_sPostmanJson)){
            $aPostmanContents = json_decode($p_sPostmanJson, true);
            if (is_array($aPostmanContents)) {
                $bIsValid = $this->isPostmanArray($aPostmanContents);
            }
        }

        return $bIsValid;
    }

    /**
     * @param array $p_aPostman
     *
     * @return bool
     */
    protected function isPostmanArray(array $p_aPostman)
    {
        return isset($p_aPostman['id'], $p_aPostman['name'], $p_aPostman['description'],
            $p_aPostman['order'], $p_aPostman['folders'], $p_aPostman['timestamp'],
            $p_aPostman['synced'], $p_aPostman['requests']) &&
            is_array($p_aPostman['order']) &&
            is_array($p_aPostman['folders']) &&
            is_array($p_aPostman['requests']) &&
            (is_integer($p_aPostman['timestamp']) || is_float($p_aPostman['timestamp']))&&
            is_bool($p_aPostman['synced'])
        ;
    }
}
