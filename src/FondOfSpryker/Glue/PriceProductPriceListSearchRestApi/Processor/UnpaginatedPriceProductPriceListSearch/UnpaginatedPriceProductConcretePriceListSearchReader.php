<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch;

use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiConfig;
use Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

class UnpaginatedPriceProductConcretePriceListSearchReader extends AbstractUnpaginatedPriceProductPriceListSearchReader
{
    /**
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     */
    protected function doSearch(string $searchString, array $requestParameters = []): array
    {
        return $this->priceProductPriceListPageSearchClient->searchConcrete($searchString, $requestParameters);
    }

    /**
     * @param \Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer $restSearchAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function buildRestResponse(RestUnpaginatedPriceProductPriceListSearchAttributesTransfer $restSearchAttributesTransfer): RestResponseInterface
    {
        $restResource = $this->restResourceBuilder->createRestResource(
            PriceProductPriceListSearchRestApiConfig::RESOURCE_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH,
            null,
            $restSearchAttributesTransfer
        );

        $response = $this->restResourceBuilder->createRestResponse();

        return $response->addResource($restResource);
    }
}
