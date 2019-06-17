<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer;
use Generated\Shared\Transfer\RestPriceProductPriceListSearchPricesTransfer;
use Generated\Shared\Transfer\RestPriceProductPriceListSearchSortTransfer;

class PriceProductConcretePriceListSearchResourceMapper implements PriceProductConcretePriceListSearchResourceMapperInterface
{
    protected const SEARCH_KEY_PRICE_PRODUCT_PRICE_LISTS = 'price_product_concrete_price_lists';
    protected const SORT_NAME = 'sort';

    /**
     * @param array $restSearchResponse
     *
     * @return \Generated\Shared\Transfer\RestCatalogSearchAttributesTransfer
     */
    public function mapRestSearchResponseToRestAttributesTransfer(array $restSearchResponse): RestPriceProductPriceListSearchAttributesTransfer
    {
        $restSearchAttributesTransfer = (new RestPriceProductPriceListSearchAttributesTransfer())
            ->fromArray($restSearchResponse, true);

        $restSearchAttributesTransfer = $this->addPrices(
            $restSearchAttributesTransfer,
            $restSearchResponse
        );

        $restSearchAttributesTransfer = $this->addSort(
            $restSearchAttributesTransfer,
            $restSearchResponse
        );

        return $restSearchAttributesTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer $restPriceProductPriceListSearchAttributesTransfer
     * @param array $restSearchResponse
     *
     * @return \Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer
     */
    protected function addPrices(
        RestPriceProductPriceListSearchAttributesTransfer $restPriceProductPriceListSearchAttributesTransfer,
        array $restSearchResponse
    ): RestPriceProductPriceListSearchAttributesTransfer {
        if (!isset($restSearchResponse[static::SEARCH_KEY_PRICE_PRODUCT_PRICE_LISTS]) || !is_array($restSearchResponse[static::SEARCH_KEY_PRICE_PRODUCT_PRICE_LISTS])) {
            return $restPriceProductPriceListSearchAttributesTransfer;
        }

        foreach ($restSearchResponse[static::SEARCH_KEY_PRICE_PRODUCT_PRICE_LISTS] as $price) {
            $restPriceProductPriceListSearchAttributesTransfer->addPrice(
                (new RestPriceProductPriceListSearchPricesTransfer())->fromArray($price, true)
            );
        }

        return $restPriceProductPriceListSearchAttributesTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer $restPriceProductPriceListSearchAttributesTransfer
     * @param array $restSearchResponse
     *
     * @return \Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer
     */
    protected function addSort(
        RestPriceProductPriceListSearchAttributesTransfer $restPriceProductPriceListSearchAttributesTransfer,
        array $restSearchResponse
    ): RestPriceProductPriceListSearchAttributesTransfer {
        $restPriceProductPriceListSearchSortTransfer = (new RestPriceProductPriceListSearchSortTransfer())
            ->fromArray($restSearchResponse[static::SORT_NAME]->toArray());

        $restPriceProductPriceListSearchAttributesTransfer->setSort($restPriceProductPriceListSearchSortTransfer);

        return $restPriceProductPriceListSearchAttributesTransfer;
    }
}
