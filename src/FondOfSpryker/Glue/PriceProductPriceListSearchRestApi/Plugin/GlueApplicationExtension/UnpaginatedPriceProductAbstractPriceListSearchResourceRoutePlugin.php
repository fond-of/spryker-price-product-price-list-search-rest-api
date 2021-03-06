<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Plugin\GlueApplicationExtension;

use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiConfig;
use Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class UnpaginatedPriceProductAbstractPriceListSearchResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @api
     *
     * {@inheritdoc}
     *
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection
            ->addGet('get', true);

        return $resourceRouteCollection;
    }

    /**
     * @api
     *
     * {@inheritdoc}
     *
     * @return string
     */
    public function getResourceType(): string
    {
        return PriceProductPriceListSearchRestApiConfig::RESOURCE_UNPAGINATED_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH;
    }

    /**
     * @api
     *
     * {@inheritdoc}
     *
     * @return string
     */
    public function getController(): string
    {
        return PriceProductPriceListSearchRestApiConfig::CONTROLLER_UNPAGINATED_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH;
    }

    /**
     * @api
     *
     * {@inheritdoc}
     *
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestUnpaginatedPriceProductPriceListSearchAttributesTransfer::class;
    }
}
