<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer;

interface PriceProductAbstractPriceListSearchResourceMapperInterface
{
    /**
     * @param array $restSearchResponse
     *
     * @return \Generated\Shared\Transfer\RestCatalogSearchAttributesTransfer
     */
    public function mapRestSearchResponseToRestAttributesTransfer(array $restSearchResponse): RestPriceProductPriceListSearchAttributesTransfer;
}
