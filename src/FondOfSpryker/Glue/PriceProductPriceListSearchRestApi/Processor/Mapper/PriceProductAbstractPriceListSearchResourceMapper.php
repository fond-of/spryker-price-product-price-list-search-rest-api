<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper;

class PriceProductAbstractPriceListSearchResourceMapper extends AbstractPriceProductPriceListSearchResourceMapper
{
    protected const SEARCH_KEY_PRICES = 'price_product_abstract_price_lists';

    /**
     * @return string
     */
    protected function getPricesSearchKey(): string
    {
        return static::SEARCH_KEY_PRICES;
    }
}
