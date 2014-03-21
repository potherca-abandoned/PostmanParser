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

    /**
     * Populate given collection with given JSON string.
     *
     * If given string is not valid Postman JSON an InvalidArgumentException
     * will be thrown.
     *
     * @param $p_sPostmanJson
     * @param \Potherca\PostmanParser\Collection $p_oCollection
     *
     * @throws \InvalidArgumentException
     * @return PostmanItemCollection
     */
    public function fillCollectionFromString($p_sPostmanJson, Collection $p_oCollection)
    {
        $aJson = $this->parseJson($p_sPostmanJson);

        if (is_array($aJson) === false) {
            throw new \InvalidArgumentException(self::ERROR_JSON_DOES_NOT_REPRESENT_POSTMAN_COLLECTION);
        } else {
            $p_oCollection->setId($aJson[PostmanItemCollection::ATTRIBUTE_ID]);
            $p_oCollection->setName($aJson[PostmanItemCollection::ATTRIBUTE_NAME]);
            $p_oCollection->setDescription($aJson[PostmanItemCollection::ATTRIBUTE_DESCRIPTION]);
            
            $p_oCollection->setOrder($aJson[PostmanItemCollection::ATTRIBUTE_ORDER]);

//            $p_oCollection->setFolders($aJson[Collection::ATTRIBUTE_FOLDERS]);
            $p_oCollection->setRequests($aJson[Collection::ATTRIBUTE_REQUESTS]);
//            $p_oCollection->setSynced($aJson[Collection::ATTRIBUTE_SYNCED]);
//            $p_oCollection->setTimestamp($aJson[Collection::ATTRIBUTE_TIMESTAMP]);

            return $p_oCollection;
        }
    }

    /**
     * Populate given collection with content from given File.
     *
     * If given file is not a valid Postman file an InvalidArgumentException
     * will be thrown.
     *
     * @param \SplFileObject $oFile
     * @param PostmanItemCollection $p_oCollection
     *
     * @throws \InvalidArgumentException
     *
     * @return Collection
     */
    public function fillCollectionFromFile(\SplFileObject $oFile, PostmanItemCollection $p_oCollection)
    {
        $sContent = '';

        foreach ($oFile as $t_sLine) {
            $sContent .= $t_sLine;
        }

        return $this->fillCollectionFromString($sContent, $p_oCollection);
    }

//////////////////////////////// UTILITY METHODS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * Parses given JSON string
     *
     * Return Array representation of given JSON string if given string is
     * valid Postman JSON collection, null otherwise.
     *
     * @param string $p_sPostmanJson
     *
     * @return null|array
     */
    protected function parseJson($p_sPostmanJson)
    {
        $aJson = null;

        if(is_string($p_sPostmanJson)){
            $aPostmanContents = json_decode($p_sPostmanJson, true);
            if ($this->isPostmanArray($aPostmanContents)) {
                $aJson = $aPostmanContents;
            }
        }

        return $aJson;
    }

    /**
     * @param mixed $p_aPostman
     *
     * @return bool
     */
    protected function isPostmanArray($p_aPostman)
    {
        return  is_array($p_aPostman) &&
            isset($p_aPostman[PostmanItemCollection::ATTRIBUTE_ID], $p_aPostman[PostmanItemCollection::ATTRIBUTE_NAME], $p_aPostman[PostmanItemCollection::ATTRIBUTE_DESCRIPTION],
            $p_aPostman[PostmanItemCollection::ATTRIBUTE_ORDER], $p_aPostman[Collection::ATTRIBUTE_FOLDERS], $p_aPostman[Collection::ATTRIBUTE_TIMESTAMP],
            $p_aPostman[Collection::ATTRIBUTE_SYNCED], $p_aPostman[Collection::ATTRIBUTE_REQUESTS]) &&
            is_array($p_aPostman[PostmanItemCollection::ATTRIBUTE_ORDER]) &&
            is_array($p_aPostman[Collection::ATTRIBUTE_FOLDERS]) &&
            is_array($p_aPostman[Collection::ATTRIBUTE_REQUESTS]) &&
            (is_integer($p_aPostman[Collection::ATTRIBUTE_TIMESTAMP]) || is_float($p_aPostman[Collection::ATTRIBUTE_TIMESTAMP]))&&
            is_bool($p_aPostman[Collection::ATTRIBUTE_SYNCED])
        ;
    }
}
