<?php

namespace Potherca\PostmanParser;

use Potherca\PostmanParser\Items\Folder;
use Potherca\PostmanParser\Items\Request;

/**
 * Test class for PostmanParser
 *
 * @coversDefaultClass \Potherca\PostmanParser\Collection
 * @covers ::<!public>
 */
class CollectionTest extends \PHPUnit_Framework_TestCase
{
    ////////////////////////////////// FIXTURES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /** @var  Collection */
    protected $collection;

    public function setup()
    {
        $this->collection = new Collection();
    }

    /////////////////////////////////// TESTS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @test
     *
     * @covers ::setFolders
     * @covers ::getFolders
     */
    public function collectionShouldAcceptEmptyArrayWhenGivenFolders()
    {
        $oCollection = $this->collection;

        $aExpected = array();

        $oCollection->setFolders($aExpected);

        $aActual = $oCollection->getFolders();

        $this->assertSame($aExpected, $aActual);
    }

    /**
     * @param $p_mInvalidArgument
     *
     * @test
     *
     * @covers ::setFolders
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage \Potherca\PostmanParser\Collection::ERROR_SHOULD_ONLY_CONTAIN_FOLDERS
     *
     * @dataProvider provideInvalidArgumentTypes
     */
    public function collectionShouldProtestWhenGivenInvalidFolders($p_mInvalidArgument)
    {
        $oCollection = $this->collection;

        $aFolders = array($p_mInvalidArgument);

        $oCollection->setFolders($aFolders);
    }

    /**
     * @test
     *
     * @covers ::setFolders
     * @covers ::getFolders
     */
    public function collectionShouldOnlyAcceptAnArrayOfFoldersWhenGivenFolders()
    {
        $oCollection = $this->collection;

        $oMockFolder = $this->getMockBuilder(Folder::class)->getMock();

        $aExpected = array($oMockFolder);

        $oCollection->setFolders($aExpected);

        $aActual = $oCollection->getFolders();

        $this->assertSame($aExpected, $aActual);
    }

    /**
     * @test
     *
     * @covers ::setRequests
     * @covers ::getRequests
     */
    public function collectionShouldAcceptEmptyArrayWhenGivenRequests()
    {
        $oCollection = $this->collection;

        $aExpected = array();

        $oCollection->setRequests($aExpected);

        $aActual = $oCollection->getRequests();

        $this->assertSame($aExpected, $aActual);
    }

    /**
     * @param $p_mInvalidArgument
     *
     * @test
     *
     * @covers ::setRequests
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage \Potherca\PostmanParser\Collection::ERROR_SHOULD_ONLY_CONTAIN_REQUEST
     *
     * @dataProvider provideInvalidArgumentTypes
     */
    public function collectionShouldProtestWhenGivenInvalidRequests($p_mInvalidArgument)
    {
        $oCollection = $this->collection;

        $aRequests = array($p_mInvalidArgument);

        $oCollection->setRequests($aRequests);
    }

    /**
     * @test
     *
     * @covers ::setRequests
     * @covers ::getRequests
     */
    public function collectionShouldOnlyAcceptArrayOfRequestsWhenGivenRequests()
    {
        $oCollection = $this->collection;

        $oMockRequest = $this->getMockBuilder(Request::class)->getMock();

        $aExpected = array($oMockRequest);

        $oCollection->setRequests($aExpected);

        $aActual = $oCollection->getRequests();

        $this->assertSame($aExpected, $aActual);
    }

    /**
     * @test
     *
     * @covers ::setOrder
     * @covers ::getOrder
     */
    public function collectionShouldRememberOrderWhenGivenOrder()
    {
        $oCollection = $this->collection;

        $aExpected = array('one', 'two', 'three');

        $oCollection->setOrder($aExpected);

        $aActual = $oCollection->getOrder();

        $this->assertSame($aExpected, $aActual);
    }

    ////////////////////////////// MOCKS AND STUBS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /////////////////////////////// DATAPROVIDERS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    public function provideInvalidArgumentTypes()
    {
        return array(
            array(null),
            array(true),
            array(false),
            array('string'),
            array(new \stdClass()),
        );
    }
}
 