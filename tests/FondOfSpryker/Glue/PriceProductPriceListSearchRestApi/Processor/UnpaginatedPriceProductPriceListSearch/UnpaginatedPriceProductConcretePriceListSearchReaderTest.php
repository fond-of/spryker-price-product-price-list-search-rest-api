<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiConfig;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\UnpaginatedPriceProductPriceListSearchResourceMapperInterface;
use Generated\Shared\Transfer\PaginationSearchResultTransfer;
use Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class UnpaginatedPriceProductConcretePriceListSearchReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch\UnpaginatedPriceProductConcretePriceListSearchReader
     */
    protected $unpaginatedPriceProductConcretePriceListSearchReader;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface
     */
    protected $priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\UnpaginatedPriceProductPriceListSearchResourceMapperInterface
     */
    protected $unpaginatedPriceProductPriceListSearchResourceMapperInterfaceMock;

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
     * @var array
     */
    protected $searchConcrete;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaginationSearchResultTransfer
     */
    protected $paginationSearchResultTransferMock;

    /**
     * @var int
     */
    protected $currentPage;

    /**
     * @var int
     */
    protected $maxPage;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer
     */
    protected $restUnpaginatedPriceProductPriceListSearchAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

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

        $this->unpaginatedPriceProductPriceListSearchResourceMapperInterfaceMock = $this->getMockBuilder(UnpaginatedPriceProductPriceListSearchResourceMapperInterface::class)
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

        $this->paginationSearchResultTransferMock = $this->getMockBuilder(PaginationSearchResultTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchConcrete = [
            'pagination' => $this->paginationSearchResultTransferMock,
            'price_product_concrete_price_lists' => [
                '',
            ],
        ];

        $this->currentPage = 1;

        $this->maxPage = 2;

        $this->restUnpaginatedPriceProductPriceListSearchAttributesTransferMock = $this->getMockBuilder(RestUnpaginatedPriceProductPriceListSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->unpaginatedPriceProductConcretePriceListSearchReader = new UnpaginatedPriceProductConcretePriceListSearchReader(
            $this->priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock,
            $this->unpaginatedPriceProductPriceListSearchResourceMapperInterfaceMock,
            $this->restResourceBuilderInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testUnpaginatedSearch(): void
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

        $this->priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock->expects($this->atLeastOnce())
            ->method('searchConcrete')
            ->willReturn($this->searchConcrete);

        $this->paginationSearchResultTransferMock->expects($this->atLeastOnce())
            ->method('getCurrentPage')
            ->willReturnOnConsecutiveCalls($this->currentPage, $this->currentPage, $this->maxPage);

        $this->paginationSearchResultTransferMock->expects($this->atLeastOnce())
            ->method('getMaxPage')
            ->willReturn($this->maxPage);

        $this->unpaginatedPriceProductPriceListSearchResourceMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapRestSearchResponseToRestAttributesTransfer')
            ->willReturn($this->restUnpaginatedPriceProductPriceListSearchAttributesTransferMock);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->with(
                PriceProductPriceListSearchRestApiConfig::RESOURCE_UNPAGINATED_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH,
                null,
                $this->restUnpaginatedPriceProductPriceListSearchAttributesTransferMock
            )->willReturn($this->restResourceInterfaceMock);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->willReturnSelf();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->unpaginatedPriceProductConcretePriceListSearchReader->unpaginatedSearch(
                $this->restRequestInterfaceMock
            )
        );
    }
}
