<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class PriceProductPriceListSearchRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH = 'price-product-concrete-price-list-search';
    public const RESOURCE_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH = 'price-product-abstract-price-list-search';

    public const RESOURCE_UNPAGINATED_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH = 'unpaginated-price-product-concrete-price-list-search';
    public const RESOURCE_UNPAGINATED_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH = 'unpaginated-price-product-abstract-price-list-search';

    public const CONTROLLER_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH = 'price-product-concrete-price-list-search-resource';
    public const CONTROLLER_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH = 'price-product-abstract-price-list-search-resource';

    public const CONTROLLER_UNPAGINATED_PRICE_PRODUCT_CONCRETE_PRICE_LIST_SEARCH = 'unpaginated-price-product-concrete-price-list-search-resource';
    public const CONTROLLER_UNPAGINATED_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH = 'unpaginated-price-product-abstract-price-list-search-resource';

    public const QUERY_STRING_PARAMETER = 'q';
}
