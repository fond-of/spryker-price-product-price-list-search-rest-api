<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer;
use Generated\Shared\Transfer\SortConfigTransfer;

class UnpaginatedPriceProductConcretePriceListSearchResourceMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\UnpaginatedPriceProductConcretePriceListSearchResourceMapper
     */
    protected $unpaginatedPriceProductConcretePriceListSearchResourceMapper;

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
            'price_product_concrete_price_lists' => [
                [],
            ],
        ];

        $this->unpaginatedPriceProductConcretePriceListSearchResourceMapper = new UnpaginatedPriceProductConcretePriceListSearchResourceMapper();
    }

    /**
     * @return void
     */
    public function testMapRestSearchResponseToRestAttributesTransfer(): void
    {
        $this->assertInstanceOf(
            RestUnpaginatedPriceProductPriceListSearchAttributesTransfer::class,
            $this->unpaginatedPriceProductConcretePriceListSearchResourceMapper->mapRestSearchResponseToRestAttributesTransfer(
                $this->restSearchResponse
            )
        );
    }

    /**
     * @return void
     */
    public function testMapRestSearchResponseToRestAttributesTransferNoKey(): void
    {
        $this->assertInstanceOf(
            RestUnpaginatedPriceProductPriceListSearchAttributesTransfer::class,
            $this->unpaginatedPriceProductConcretePriceListSearchResourceMapper->mapRestSearchResponseToRestAttributesTransfer(
                []
            )
        );
    }
}
