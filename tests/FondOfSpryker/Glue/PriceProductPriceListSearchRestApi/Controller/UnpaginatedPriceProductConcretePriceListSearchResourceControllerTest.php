<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Controller;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiFactory;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch\UnpaginatedPriceProductPriceListSearchReaderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class UnpaginatedPriceProductConcretePriceListSearchResourceControllerTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Controller\UnpaginatedPriceProductConcretePriceListSearchResourceController
     */
    protected $unpaginatedPriceProductConcretePriceListSearchResourceController;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiFactory
     */
    protected $priceProductPriceListSearchRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch\UnpaginatedPriceProductPriceListSearchReaderInterface
     */
    protected $unpaginatedPriceProductPriceListSearchReaderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->priceProductPriceListSearchRestApiFactoryMock = $this->getMockBuilder(PriceProductPriceListSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->unpaginatedPriceProductPriceListSearchReaderInterfaceMock = $this->getMockBuilder(UnpaginatedPriceProductPriceListSearchReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->unpaginatedPriceProductConcretePriceListSearchResourceController = new class (
            $this->priceProductPriceListSearchRestApiFactoryMock
        ) extends UnpaginatedPriceProductConcretePriceListSearchResourceController {
            /**
             * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiFactory
             */
            protected $priceProductPriceListSearchRestApiFactory;

            /**
             * @param \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiFactory $priceProductPriceListSearchRestApiFactory
             */
            public function __construct(PriceProductPriceListSearchRestApiFactory $priceProductPriceListSearchRestApiFactory)
            {
                $this->priceProductPriceListSearchRestApiFactory = $priceProductPriceListSearchRestApiFactory;
            }

            /**
             * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiFactory
             */
            public function getFactory(): PriceProductPriceListSearchRestApiFactory
            {
                return $this->priceProductPriceListSearchRestApiFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testGetAction(): void
    {
        $this->priceProductPriceListSearchRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createUnpaginatedPriceProductConcretePriceListSearchReader')
            ->willReturn($this->unpaginatedPriceProductPriceListSearchReaderInterfaceMock);

        $this->unpaginatedPriceProductPriceListSearchReaderInterfaceMock->expects($this->atLeastOnce())
            ->method('unpaginatedSearch')
            ->with($this->restRequestInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->unpaginatedPriceProductConcretePriceListSearchResourceController->getAction(
                $this->restRequestInterfaceMock
            )
        );
    }
}
