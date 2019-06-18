<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer;

interface UnpaginatedPriceProductPriceListSearchResourceMapperInterface
{
    /**
     * @param array $restSearchResponse
     *
     * @return \Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer
     */
    public function mapRestSearchResponseToRestAttributesTransfer(
        array $restSearchResponse
    ): RestUnpaginatedPriceProductPriceListSearchAttributesTransfer;
}
