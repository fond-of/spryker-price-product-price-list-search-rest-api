<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestPriceProductPriceListSearchPricesTransfer;
use Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer;

abstract class AbstractUnpaginatedPriceProductPriceListSearchResourceMapper implements UnpaginatedPriceProductPriceListSearchResourceMapperInterface
{
    /**
     * @param array $restSearchResponse
     *
     * @return \Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer
     */
    public function mapRestSearchResponseToRestAttributesTransfer(
        array $restSearchResponse
    ): RestUnpaginatedPriceProductPriceListSearchAttributesTransfer {
        $restSearchAttributesTransfer = (new RestUnpaginatedPriceProductPriceListSearchAttributesTransfer())
            ->fromArray($restSearchResponse, true);

        $restSearchAttributesTransfer = $this->addPrices(
            $restSearchAttributesTransfer,
            $restSearchResponse
        );

        return $restSearchAttributesTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer $restSearchAttributesTransfer
     * @param array $restSearchResponse
     *
     * @return \Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer
     */
    protected function addPrices(
        RestUnpaginatedPriceProductPriceListSearchAttributesTransfer $restSearchAttributesTransfer,
        array $restSearchResponse
    ): RestUnpaginatedPriceProductPriceListSearchAttributesTransfer {
        $pricesSearchKey = $this->getPricesSearchKey();

        if (!isset($restSearchResponse[$pricesSearchKey]) || !is_array($restSearchResponse[$pricesSearchKey])) {
            return $restSearchAttributesTransfer;
        }

        foreach ($restSearchResponse[$pricesSearchKey] as $price) {
            $restSearchAttributesTransfer->addPrice(
                (new RestPriceProductPriceListSearchPricesTransfer())->fromArray($price, true)
            );
        }

        return $restSearchAttributesTransfer;
    }

    /**
     * @return string
     */
    abstract protected function getPricesSearchKey(): string;
}
