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
     * @covers ::parse
     *
     * @expectedException \PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage Missing argument 1
     */
    public function parse_TriggersError_WhenNotGivenJsonParameter()
    {
        $parser = $this->parser;
        /** @noinspection PhpParamsInspection */
        $parser->parse();
    }

    /**
     * @test
     *
     * @covers ::parse
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage \Potherca\PostmanParser\PostmanParser::ERROR_JSON_DOES_NOT_REPRESENT_POSTMAN_COLLECTION
     */
    public function parse_ThrowsException_WhenGivenJsonParameterNotString()
    {
        $parser = $this->parser;
        $parser->parse(array());
    }

    /**
     * @test
     *
     * @covers ::parse
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage \Potherca\PostmanParser\PostmanParser::ERROR_JSON_DOES_NOT_REPRESENT_POSTMAN_COLLECTION
     */
    public function parse_ThrowsException_WhenGivenJsonParameterNotValidJson()
    {
        $parser = $this->parser;
        $json = '<div>Not Valid Json</div>';
        $parser->parse($json);
    }

    /**
     * @test
     *
     * @covers ::parse
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage \Potherca\PostmanParser\PostmanParser::ERROR_JSON_DOES_NOT_REPRESENT_POSTMAN_COLLECTION
     */
    public function parse_ThrowsException_WhenGivenJsonNotPostmanCompatible()
    {
        $parser = $this->parser;
        $json = '{}';
        $parser->parse($json);
    }

    /**
     * @test
     *
     * @covers ::parse
     *
     * @dataProvider dataProvider_validJson
     */
    public function parse_ReturnsCollection_WhenGivenValidPostmanJson($json)
    {
        $parser = $this->parser;

        $collection = $parser->parse($json);

        $this->assertInstanceOf('Potherca\PostmanParser\Collection', $collection);
    }

    /**
     * @test
     *
     * @coversNothing
     *
     * @expectedException \PHPUnit_Framework_Error
     * @expectedExceptionMessage must be an instance of SplFileObject
     */
    public function collectionFromFile_TriggersError_WhenNotGivenFile()
    {
        $parser = $this->parser;
        /** @noinspection PhpParamsInspection */
        $parser->collectionFromFile();
    }

    /**
     * @test
     *
     * @covers ::collectionFromFile
     *
     * @depends parse_ReturnsCollection_WhenGivenValidPostmanJson
     *
     * @dataProvider dataProvider_validJson
     */
    public function collectionFromFile_ReturnCollection_WhenGivenFileContainsValidJson($json)
    {
        $parser = $this->parser;

        $file = $this->getMockSplFileObject($json);

        $collection = $parser->collectionFromFile($file);

        $this->assertInstanceOf('\Potherca\PostmanParser\Collection', $collection);
    }

//////////////////////////////// MOCKS AND STUBS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
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

        $fileObject->expects($this->exactly($iLength))
            ->method('valid')
            ->will($this->returnCallback(
                function() use ($aFileContent){
                    return array_pop($aFileContent);
                })
            )
        ;

        $fileObject->expects($this->exactly($iLength))
            ->method('current')
            ->will($this->returnCallback(
                function() use ($aFileContent, $iLength){
                    return count($aFileContent) < $iLength;
                })
            )
        ;

        return $fileObject;
    }

///////////////////////////////// DATAPROVIDERS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @return string
     */
    public function dataProvider_validJson()
    {
        $json = '{
            "id": "foo-bar-baz-id-123",
            "name": "Example Postman Collection",
            "description": "Description of Example Postman Collection",
            "order": [],
            "folders": [],
            "timestamp": 1234567890123,
            "synced": false,
            "requests": []
        }';

        return array(array($json));
    }
}

//EOF