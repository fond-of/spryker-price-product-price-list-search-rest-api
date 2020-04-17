<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiConfig;
use Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class UnpaginatedPriceProductAbstractPriceListSearchResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Plugin\GlueApplicationExtension\UnpaginatedPriceProductAbstractPriceListSearchResourceRoutePlugin
     */
    protected $unpaginatedPriceProductAbstractPriceListSearchResourceRoutePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->resourceRouteCollectionInterfaceMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->unpaginatedPriceProductAbstractPriceListSearchResourceRoutePlugin = new UnpaginatedPriceProductAbstractPriceListSearchResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionInterfaceMock->expects($this->atLeastOnce())
            ->method('addGet')
            ->with('get', true)
            ->willReturnSelf();

        $this->assertInstanceOf(
            ResourceRouteCollectionInterface::class,
            $this->unpaginatedPriceProductAbstractPriceListSearchResourceRoutePlugin->configure(
                $this->resourceRouteCollectionInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertSame(
            PriceProductPriceListSearchRestApiConfig::RESOURCE_UNPAGINATED_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH,
            $this->unpaginatedPriceProductAbstractPriceListSearchResourceRoutePlugin->getResourceType()
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame(
            PriceProductPriceListSearchRestApiConfig::CONTROLLER_UNPAGINATED_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH,
            $this->unpaginatedPriceProductAbstractPriceListSearchResourceRoutePlugin->getController()
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(
            RestUnpaginatedPriceProductPriceListSearchAttributesTransfer::class,
            $this->unpaginatedPriceProductAbstractPriceListSearchResourceRoutePlugin->getResourceAttributesClassName()
        );
    }
}
