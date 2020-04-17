<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Controller;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiFactory;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductPriceListSearchReaderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class PriceProductConcretePriceListSearchResourceControllerTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Controller\PriceProductConcretePriceListSearchResourceController
     */
    protected $priceProductConcretePriceListSearchResourceController;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiFactory
     */
    protected $priceProductPriceListSearchRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductPriceListSearchReaderInterface
     */
    protected $priceProductPriceListSearchReaderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->priceProductPriceListSearchRestApiFactoryMock = $this->getMockBuilder(PriceProductPriceListSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListSearchReaderInterfaceMock = $this->getMockBuilder(PriceProductPriceListSearchReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductConcretePriceListSearchResourceController = new class (
            $this->priceProductPriceListSearchRestApiFactoryMock
        ) extends PriceProductConcretePriceListSearchResourceController {
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
            ->method('createPriceProductConcretePriceListSearchReader')
            ->willReturn($this->priceProductPriceListSearchReaderInterfaceMock);

        $this->priceProductPriceListSearchReaderInterfaceMock->expects($this->atLeastOnce())
            ->method('search')
            ->with($this->restRequestInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->priceProductConcretePriceListSearchResourceController->getAction(
                $this->restRequestInterfaceMock
            )
        );
    }
}
