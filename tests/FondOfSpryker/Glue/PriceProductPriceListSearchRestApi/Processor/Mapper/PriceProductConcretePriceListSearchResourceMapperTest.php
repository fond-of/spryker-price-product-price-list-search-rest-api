<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer;
use Generated\Shared\Transfer\SortConfigTransfer;

class PriceProductConcretePriceListSearchResourceMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductConcretePriceListSearchResourceMapper
     */
    protected $priceProductConcretePriceListSearchResourceMapper;

    /**
     * @var array
     */
    protected $restSearchResponse;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SortConfigTransfer
     */
    protected $sortConfigTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->sortConfigTransferMock = $this->getMockBuilder(SortConfigTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSearchResponse = [
            'price_product_concrete_price_lists' => [
                [],
            ],
            'sort' => $this->sortConfigTransferMock,
        ];

        $this->priceProductConcretePriceListSearchResourceMapper = new PriceProductConcretePriceListSearchResourceMapper();
    }

    /**
     * @return void
     */
    public function testMapRestSearchResponseToRestAttributesTransfer(): void
    {
        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->assertInstanceOf(
            RestPriceProductPriceListSearchAttributesTransfer::class,
            $this->priceProductConcretePriceListSearchResourceMapper->mapRestSearchResponseToRestAttributesTransfer(
                $this->restSearchResponse
            )
        );
    }
}
