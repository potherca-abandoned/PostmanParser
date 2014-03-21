<?php

namespace Potherca\PostmanParser;

/**
 * Test class for PostmanParser
 *
 * @coversDefaultClass \Potherca\PostmanParser\PostmanParser
 * @covers ::<!public>
 */
class PostmanParserTest extends \PHPUnit_Framework_TestCase
{
//////////////////////////////////// FIXTURES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    protected $m_aValidJson = array(
        'id' => 'foo-bar-baz-id-123',
        'name' => 'Example Postman Collection',
        'description' => 'Description of Example Postman Collection',
        'order' =>
            array(),
        'folders' =>
            array(),
        'timestamp' => 1234567890123,
        'synced' => false,
        'requests' =>
            array(),
    );
    /** @var PostmanParser */
    protected $parser = null;

    public function setUp()
    {
        $this->parser = new PostmanParser();
    }

///////////////////////////////////// TESTS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @test
     *
     * @covers ::fillCollectionFromString
     *
     * @expectedException \PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage Missing argument 1
     */
    public function fillCollectionFromString_TriggersError_WhenNotGivenJsonParameter()
    {
        $parser = $this->parser;
        /** @noinspection PhpParamsInspection */
        $parser->fillCollectionFromString();
    }

    /**
     * @test
     *
     * @covers ::fillCollectionFromString
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage \Potherca\PostmanParser\PostmanParser::ERROR_JSON_DOES_NOT_REPRESENT_POSTMAN_COLLECTION
     */
    public function fillCollectionFromString_ThrowsException_WhenGivenJsonParameterNotString()
    {
        $mockCollection = $this->getMockCollection();

        $parser = $this->parser;

        $parser->fillCollectionFromString(array(), $mockCollection);
    }

    /**
     * @test
     *
     * @covers ::fillCollectionFromString
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage \Potherca\PostmanParser\PostmanParser::ERROR_JSON_DOES_NOT_REPRESENT_POSTMAN_COLLECTION
     */
    public function fillCollectionFromString_ThrowsException_WhenGivenJsonParameterNotValidJson()
    {
        $parser = $this->parser;

        $mockCollection = $this->getMockCollection();

        $json = '<div>Not Valid Json</div>';

        $parser->fillCollectionFromString($json, $mockCollection);
    }

    /**
     * @test
     *
     * @covers ::fillCollectionFromString
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage \Potherca\PostmanParser\PostmanParser::ERROR_JSON_DOES_NOT_REPRESENT_POSTMAN_COLLECTION
     */
    public function fillCollectionFromString_ThrowsException_WhenGivenJsonNotPostmanCompatible()
    {
        $parser = $this->parser;

        $mockCollection = $this->getMockCollection();

        $json = '{}';

        $parser->fillCollectionFromString($json, $mockCollection);
    }

    /**
     * @test
     *
     * @covers ::fillCollectionFromString
     *
     * @expectedException \PHPUnit_Framework_Error
     * @expectedExceptionMessage must be an instance of Potherca\PostmanParser\Collection
     */
    public function fillCollectionFromString_TriggersError_WhenNotGivenCollectionParameter()
    {
        $parser = $this->parser;
        /** @noinspection PhpParamsInspection */
        $parser->fillCollectionFromString('');
    }

    /**
     * @test
     *
     * @covers ::fillCollectionFromString
     *
     * @expectedException \PHPUnit_Framework_Error
     * @expectedExceptionMessage must be an instance of Potherca\PostmanParser\Collection
     */
    public function fillCollectionFromString_ThrowsException_WhenGivenCollectionParameterNotCollection()
    {
        $parser = $this->parser;
        /** @noinspection PhpParamsInspection */
        $parser->fillCollectionFromString(''. 'foo');
    }

    /**
     * @test
     *
     * @covers ::fillCollectionFromString
     */
    public function fillCollectionFromString_ReturnsGivenCollection_WhenGivenValidPostmanJsonAndCollection()
    {
        $parser = $this->parser;

        $json = $this->getValidJson();

        $mockCollection = $this->getMockCollection();

        $collection = $parser->fillCollectionFromString($json, $mockCollection);

        $this->assertSame($mockCollection, $collection);
    }

    /**
     * @test
     *
     * @covers ::fillCollectionFromString
     */
    public function fillCollectionFromString_ReturnedCollectionHasAttributesFromPostmanJson_WhenGivenValidPostmanJson()
    {
        $parser = $this->parser;

        $json = $this->getValidJson();
        $jsonArray = $this->m_aValidJson;

        $mockCollection = $this->getMockCollection();

        $mockCollection->expects($this->exactly(1))
            -> method('setId')
            -> with($jsonArray[PostmanItem::ATTRIBUTE_ID])
        ;

        $mockCollection->expects($this->exactly(1))
            -> method('setName')
            -> with($jsonArray[PostmanItem::ATTRIBUTE_NAME])
        ;

        $mockCollection->expects($this->exactly(1))
            -> method('setDescription')
            -> with($jsonArray[PostmanItem::ATTRIBUTE_DESCRIPTION])
        ;

        $mockCollection->expects($this->exactly(1))
            -> method('setOrder')
            -> with($jsonArray[Collection::ATTRIBUTE_ORDER])
        ;

        $mockCollection->expects($this->exactly(1))
            -> method('setFolders')
            -> with($jsonArray[Collection::ATTRIBUTE_FOLDERS])
        ;

        $this->fail('HIER GEBLEVEN');

        $parser->fillCollectionFromString($json, $mockCollection);
    }


    /**
     * @test
     *
     * @coversNothing
     *
     * @expectedException \PHPUnit_Framework_Error
     * @expectedExceptionMessage must be an instance of SplFileObject
     */
    public function fillCollectionFromFile_TriggersError_WhenNotGivenFile()
    {
        $parser = $this->parser;
        /** @noinspection PhpParamsInspection */
        $parser->fillCollectionFromFile();
    }

    /**
     * @test
     *
     * @covers ::fillCollectionFromString
     * @covers ::fillCollectionFromFile
     * @covers \PHPUnit_Framework_MockObject_Generator::evalClass
     *
     * @depends fillCollectionFromString_ReturnsCollection_WhenGivenValidPostmanJson
     */
    public function fillCollectionFromFile_ReturnCollection_WhenGivenFileContainsValidJson()
    {
        $parser = $this->parser;

        $json = $this->getValidJson();

        $mockFile = $this->getMockSplFileObject($json);
        $mockCollection = $this->getMockCollection();

        $collection = $parser->fillCollectionFromFile($mockFile, $mockCollection);

        $this->assertInstanceOf('\Potherca\PostmanParser\Collection', $collection);
    }

//////////////////////////////// MOCKS AND STUBS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Collection
     */
    protected function getMockCollection()
    {
        $mockCollection = $this->getMockBuilder('Potherca\PostmanParser\Collection')
            ->setMethods(
                array(
                    'setId', 'setName', 'setDescription', 'setOrder',
                    'setFolders', 'setRequests', 'setSynced', 'setTimestamp'
                )
            )
            ->getMock()
        ;

        return $mockCollection;
    }

    /**
     * @param string $p_sFileContents
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\SplFileObject
     */
    protected function getMockSplFileObject($p_sFileContents)
    {
        $sFileContents = 'data:text/plaintext;base64,' . base64_encode($p_sFileContents);
        $aFileContent = explode("\n", $p_sFileContents);

        $fileObject = $this->getMockBuilder('\SplFileObject')
            ->setConstructorArgs(array($sFileContents))
            ->setMethods(array('current', 'valid'))
            ->getMock()
        ;

        $iLength = count($aFileContent);

        $fileObject->expects($this->exactly($iLength + 1))
            ->method('valid')
            ->will($this->returnCallback(
                function() use ($aFileContent, $iLength){
                    static $iCounter;

                    if($iCounter === null){
                        $iCounter = $iLength;
                    }

                    return ($iCounter--) > 0;
                })
            )
        ;

        $fileObject->expects($this->exactly($iLength))
            ->method('current')
            ->will($this->returnCallback(
                function() use ($aFileContent, $iLength){
                    static $iCounter;

                    if($iCounter === null){
                        $iCounter = $iLength;
                    }

                    return $aFileContent[$iLength - $iCounter--];
                })
            )
        ;

        return $fileObject;
    }

///////////////////////////////// DATAPROVIDERS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @return string
     */
    public function getValidJson()
    {
        return json_encode($this->m_aValidJson);
    }
}

//EOF