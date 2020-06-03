<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer;
use Generated\Shared\Transfer\SortConfigTransfer;

class UnpaginatedPriceProductAbstractPriceListSearchResourceMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\UnpaginatedPriceProductAbstractPriceListSearchResourceMapper
     */
    protected $unpaginatedPriceProductAbstractPriceListSearchResourceMapper;

    /**
     * @var array
     */
    protected $restSearchResponse;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restSearchResponse = [
            'price_product_abstract_price_lists' => [
                [],
            ],
        ];

        $this->unpaginatedPriceProductAbstractPriceListSearchResourceMapper = new UnpaginatedPriceProductAbstractPriceListSearchResourceMapper();
    }

    /**
     * @return void
     */
    public function testMapRestSearchResponseToRestAttributesTransfer(): void
    {
        $this->assertInstanceOf(
            RestUnpaginatedPriceProductPriceListSearchAttributesTransfer::class,
            $this->unpaginatedPriceProductAbstractPriceListSearchResourceMapper->mapRestSearchResponseToRestAttributesTransfer(
                $this->restSearchResponse
            )
        );
    }
}
