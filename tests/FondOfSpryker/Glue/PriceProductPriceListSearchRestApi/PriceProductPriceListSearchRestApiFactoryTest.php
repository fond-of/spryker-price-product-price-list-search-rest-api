<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductPriceListSearchReaderInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch\UnpaginatedPriceProductPriceListSearchReaderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Container;

class PriceProductPriceListSearchRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiFactory
     */
    protected $priceProductPriceListSearchRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface
     */
    protected $priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock = $this->getMockBuilder(PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListSearchRestApiFactory = new class (
            $this->restResourceBuilderInterfaceMock
        ) extends PriceProductPriceListSearchRestApiFactory {
            /**
             * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            protected $restResourceBuilder;

            /**
             * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
             */
            public function __construct(RestResourceBuilderInterface $restResourceBuilder)
            {
                $this->restResourceBuilder = $restResourceBuilder;
            }

            /**
             * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            public function getResourceBuilder(): RestResourceBuilderInterface
            {
                return $this->restResourceBuilder;
            }
        };
        $this->priceProductPriceListSearchRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreatePriceProductConcretePriceListSearchReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(PriceProductPriceListSearchRestApiDependencyProvider::CLIENT_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH)
            ->willReturn($this->priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock);

        $this->assertInstanceOf(
            PriceProductPriceListSearchReaderInterface::class,
            $this->priceProductPriceListSearchRestApiFactory->createPriceProductConcretePriceListSearchReader()
        );
    }

    /**
     * @return void
     */
    public function testCreatePriceProductAbstractPriceListSearchReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(PriceProductPriceListSearchRestApiDependencyProvider::CLIENT_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH)
            ->willReturn($this->priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock);

        $this->assertInstanceOf(
            PriceProductPriceListSearchReaderInterface::class,
            $this->priceProductPriceListSearchRestApiFactory->createPriceProductAbstractPriceListSearchReader()
        );
    }

    /**
     * @return void
     */
    public function testCreateUnpaginatedPriceProductConcretePriceListSearchReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(PriceProductPriceListSearchRestApiDependencyProvider::CLIENT_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH)
            ->willReturn($this->priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock);

        $this->assertInstanceOf(
            UnpaginatedPriceProductPriceListSearchReaderInterface::class,
            $this->priceProductPriceListSearchRestApiFactory->createUnpaginatedPriceProductConcretePriceListSearchReader()
        );
    }

    /**
     * @return void
     */
    public function testCreateUnpaginatedPriceProductAbstractPriceListSearchReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(PriceProductPriceListSearchRestApiDependencyProvider::CLIENT_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH)
            ->willReturn($this->priceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterfaceMock);

        $this->assertInstanceOf(
            UnpaginatedPriceProductPriceListSearchReaderInterface::class,
            $this->priceProductPriceListSearchRestApiFactory->createUnpaginatedPriceProductAbstractPriceListSearchReader()
        );
    }
}
