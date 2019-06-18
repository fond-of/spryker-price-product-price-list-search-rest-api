<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer;

interface PriceProductPriceListSearchResourceMapperInterface
{
    /**
     * @param array $restSearchResponse
     *
     * @return \Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer
     */
    public function mapRestSearchResponseToRestAttributesTransfer(
        array $restSearchResponse
    ): RestPriceProductPriceListSearchAttributesTransfer;
}
