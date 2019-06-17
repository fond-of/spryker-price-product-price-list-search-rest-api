<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client;

use FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchClientInterface;

class PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientBridge implements PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface
{
    /**
     * @var \FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchClientInterface
     */
    protected $priceProductPriceListPageSearchClient;

    /**
     * @param \FondOfSpryker\Client\PriceProductPriceListPageSearch\PriceProductPriceListPageSearchClientInterface $priceProductPriceListPageSearchClient
     */
    public function __construct(PriceProductPriceListPageSearchClientInterface $priceProductPriceListPageSearchClient)
    {
        $this->priceProductPriceListPageSearchClient = $priceProductPriceListPageSearchClient;
    }

    /**
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     */
    public function searchAbstract(string $searchString, array $requestParameters): array
    {
        return $this->priceProductPriceListPageSearchClient->searchAbstract($searchString, $requestParameters);
    }

    /**
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     */
    public function searchConcrete(string $searchString, array $requestParameters): array
    {
        return $this->priceProductPriceListPageSearchClient->searchConcrete($searchString, $requestParameters);
    }
}
