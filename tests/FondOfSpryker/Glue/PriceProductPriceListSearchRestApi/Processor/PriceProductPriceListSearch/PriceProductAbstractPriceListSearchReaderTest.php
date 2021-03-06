<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiConfig;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductPriceListSearchResourceMapperInterface;
use Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer;
use Generated\Shared\Transfer\RestPriceProductPriceListSearchPaginationTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\PageInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class PriceProductAbstractPriceListSearchReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductAbstractPriceListSearchReader
     */
    protected $priceProductAbstractPriceListSearchReader;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface
     */
    protected $priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductPriceListSearchResourceMapperInterface
     */
    protected $priceProductPriceListSearchResourceMapperInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request
     */
    protected $requestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameterBag;

    /**
     * @var string
     */
    protected $requestParameter;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\PageInterface
     */
    protected $pageInterfaceMock;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    protected $offset;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer
     */
    protected $restPriceProductPriceListSearchAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestPriceProductPriceListSearchPaginationTransfer
     */
    protected $restPriceProductPriceListSearchPaginationTransferMock;

    /**
     * @var int
     */
    protected $numFound;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock = $this->getMockBuilder(PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListSearchResourceMapperInterfaceMock = $this->getMockBuilder(PriceProductPriceListSearchResourceMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->parameterBag = $this->getMockBuilder(ParameterBag::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock->query = $this->parameterBag;

        $this->requestParameter = '';

        $this->pageInterfaceMock = $this->getMockBuilder(PageInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->limit = 1;

        $this->offset = 1;

        $this->restPriceProductPriceListSearchAttributesTransferMock = $this->getMockBuilder(RestPriceProductPriceListSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restPriceProductPriceListSearchPaginationTransferMock = $this->getMockBuilder(RestPriceProductPriceListSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->numFound = 2;

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductAbstractPriceListSearchReader = new PriceProductAbstractPriceListSearchReader(
            $this->priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock,
            $this->priceProductPriceListSearchResourceMapperInterfaceMock,
            $this->restResourceBuilderInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testSearch(): void
    {
        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->requestMock);

        $this->parameterBag->expects($this->atLeastOnce())
            ->method('get')
            ->with(PriceProductPriceListSearchRestApiConfig::QUERY_STRING_PARAMETER, '')
            ->willReturn($this->requestParameter);

        $this->parameterBag->expects($this->atLeastOnce())
            ->method('all')
            ->willReturn([]);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getPage')
            ->willReturn($this->pageInterfaceMock);

        $this->pageInterfaceMock->expects($this->atLeastOnce())
            ->method('getLimit')
            ->willReturn($this->limit);

        $this->pageInterfaceMock->expects($this->atLeastOnce())
            ->method('getOffset')
            ->willReturn($this->offset);

        $this->priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock->expects($this->atLeastOnce())
            ->method('searchAbstract')
            ->willReturn([]);

        $this->priceProductPriceListSearchResourceMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapRestSearchResponseToRestAttributesTransfer')
            ->willReturn($this->restPriceProductPriceListSearchAttributesTransferMock);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->with(
                PriceProductPriceListSearchRestApiConfig::RESOURCE_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH,
                null,
                $this->restPriceProductPriceListSearchAttributesTransferMock
            )->willReturn($this->restResourceInterfaceMock);

        $this->restPriceProductPriceListSearchAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getPagination')
            ->willReturn($this->restPriceProductPriceListSearchPaginationTransferMock);

        $this->restPriceProductPriceListSearchPaginationTransferMock->expects($this->atLeastOnce())
            ->method('getNumFound')
            ->willReturn($this->numFound);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->with($this->numFound)
            ->willReturn($this->restResponseInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceInterfaceMock)
            ->willReturnSelf();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->priceProductAbstractPriceListSearchReader->search(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testSearchPageNull(): void
    {
        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->requestMock);

        $this->parameterBag->expects($this->atLeastOnce())
            ->method('get')
            ->with(PriceProductPriceListSearchRestApiConfig::QUERY_STRING_PARAMETER, '')
            ->willReturn($this->requestParameter);

        $this->parameterBag->expects($this->atLeastOnce())
            ->method('all')
            ->willReturn([]);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getPage')
            ->willReturn(null);

        $this->priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock->expects($this->atLeastOnce())
            ->method('searchAbstract')
            ->willReturn([]);

        $this->priceProductPriceListSearchResourceMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapRestSearchResponseToRestAttributesTransfer')
            ->willReturn($this->restPriceProductPriceListSearchAttributesTransferMock);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->with(
                PriceProductPriceListSearchRestApiConfig::RESOURCE_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH,
                null,
                $this->restPriceProductPriceListSearchAttributesTransferMock
            )->willReturn($this->restResourceInterfaceMock);

        $this->restPriceProductPriceListSearchAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getPagination')
            ->willReturn($this->restPriceProductPriceListSearchPaginationTransferMock);

        $this->restPriceProductPriceListSearchPaginationTransferMock->expects($this->atLeastOnce())
            ->method('getNumFound')
            ->willReturn($this->numFound);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->with($this->numFound)
            ->willReturn($this->restResponseInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceInterfaceMock)
            ->willReturnSelf();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->priceProductAbstractPriceListSearchReader->search(
                $this->restRequestInterfaceMock
            )
        );
    }
}
