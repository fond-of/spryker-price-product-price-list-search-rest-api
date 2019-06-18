<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer;
use Generated\Shared\Transfer\RestPriceProductPriceListSearchPricesTransfer;
use Generated\Shared\Transfer\RestPriceProductPriceListSearchSortTransfer;

abstract class AbstractPriceProductPriceListSearchResourceMapper implements PriceProductPriceListSearchResourceMapperInterface
{
    protected const SORT_NAME = 'sort';

    /**
     * @param array $restSearchResponse
     *
     * @return \Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer
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
     * @param \Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer $restSearchAttributesTransfer
     * @param array $restSearchResponse
     *
     * @return \Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer
     */
    protected function addPrices(
        RestPriceProductPriceListSearchAttributesTransfer $restSearchAttributesTransfer,
        array $restSearchResponse
    ): RestPriceProductPriceListSearchAttributesTransfer {
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
     * @param \Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer $restSearchAttributesTransfer
     * @param array $restSearchResponse
     *
     * @return \Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer
     */
    protected function addSort(
        RestPriceProductPriceListSearchAttributesTransfer $restSearchAttributesTransfer,
        array $restSearchResponse
    ): RestPriceProductPriceListSearchAttributesTransfer {
        $restPriceProductPriceListSearchSortTransfer = (new RestPriceProductPriceListSearchSortTransfer())
            ->fromArray($restSearchResponse[static::SORT_NAME]->toArray());

        $restSearchAttributesTransfer->setSort($restPriceProductPriceListSearchSortTransfer);

        return $restSearchAttributesTransfer;
    }

    /**
     * @return string
     */
    abstract protected function getPricesSearchKey(): string;
}
