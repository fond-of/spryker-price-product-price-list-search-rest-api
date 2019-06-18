<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch;

use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiConfig;
use Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\Page;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class PriceProductConcretePriceListSearchReader extends AbstractPriceProductPriceListSearchReader
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer $restPriceProductPriceListSearchAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function buildRestResponse(
        RestRequestInterface $restRequest,
        RestPriceProductPriceListSearchAttributesTransfer $restPriceProductPriceListSearchAttributesTransfer
    ): RestResponseInterface {
        $restResource = $this->restResourceBuilder->createRestResource(
            PriceProductPriceListSearchRestApiConfig::RESOURCE_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH,
            null,
            $restPriceProductPriceListSearchAttributesTransfer
        );

        $response = $this->restResourceBuilder->createRestResponse(
            $restPriceProductPriceListSearchAttributesTransfer->getPagination()->getNumFound()
        );

        if (!$restRequest->getPage()) {
            $restRequest->setPage(new Page(0, static::DEFAULT_ITEMS_PER_PAGE));
        }

        return $response->addResource($restResource);
    }

    /**
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     */
    protected function doSearch(string $searchString, array $requestParameters): array
    {
        return $this->priceProductPriceListPageSearchClient->searchConcrete($searchString, $requestParameters);
    }
}
