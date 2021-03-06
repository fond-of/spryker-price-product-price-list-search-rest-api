<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiConfig;
use Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class PriceProductConcretePriceListSearchResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Plugin\GlueApplicationExtension\PriceProductConcretePriceListSearchResourceRoutePlugin
     */
    protected $priceProductConcretePriceListSearchResourceRoutePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->resourceRouteCollectionTransferMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductConcretePriceListSearchResourceRoutePlugin = new PriceProductConcretePriceListSearchResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionTransferMock->expects($this->atLeastOnce())
            ->method('addGet')
            ->with('get', true)
            ->willReturnSelf();

        $this->assertInstanceOf(
            ResourceRouteCollectionInterface::class,
            $this->priceProductConcretePriceListSearchResourceRoutePlugin->configure(
                $this->resourceRouteCollectionTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertSame(
            PriceProductPriceListSearchRestApiConfig::RESOURCE_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH,
            $this->priceProductConcretePriceListSearchResourceRoutePlugin->getResourceType()
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame(
            PriceProductPriceListSearchRestApiConfig::CONTROLLER_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH,
            $this->priceProductConcretePriceListSearchResourceRoutePlugin->getController()
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(
            RestPriceProductPriceListSearchAttributesTransfer::class,
            $this->priceProductConcretePriceListSearchResourceRoutePlugin->getResourceAttributesClassName()
        );
    }
}
