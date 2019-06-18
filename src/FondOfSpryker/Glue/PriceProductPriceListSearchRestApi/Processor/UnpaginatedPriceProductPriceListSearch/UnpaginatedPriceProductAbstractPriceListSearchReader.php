<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch;

use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiConfig;
use Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

class UnpaginatedPriceProductAbstractPriceListSearchReader extends AbstractUnpaginatedPriceProductPriceListSearchReader
{
    protected const SEARCH_KEY_PRICES = 'price_product_abstract_price_lists';

    /**
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     */
    protected function doSearch(string $searchString, array $requestParameters = []): array
    {
        return $this->priceProductPriceListPageSearchClient->searchAbstract($searchString, $requestParameters);
    }

    /**
     * @param \Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer $restSearchAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function buildRestResponse(
        RestUnpaginatedPriceProductPriceListSearchAttributesTransfer $restSearchAttributesTransfer
    ): RestResponseInterface {
        $restResource = $this->restResourceBuilder->createRestResource(
            PriceProductPriceListSearchRestApiConfig::RESOURCE_UNPAGINATED_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH,
            null,
            $restSearchAttributesTransfer
        );

        $response = $this->restResourceBuilder->createRestResponse();

        return $response->addResource($restResource);
    }

    /**
     * @return string
     */
    protected function getPricesSearchKey(): string
    {
        return static::SEARCH_KEY_PRICES;
    }
}
