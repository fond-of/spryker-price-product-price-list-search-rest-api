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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SortConfigTransfer
     */
    protected $sortConfigTransferMock;

    /**
     * @var array
     */
    protected $restSearchResponse;

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

        $this->unpaginatedPriceProductConcretePriceListSearchResourceMapper = new UnpaginatedPriceProductConcretePriceListSearchResourceMapper();
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
        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->assertInstanceOf(
            RestUnpaginatedPriceProductPriceListSearchAttributesTransfer::class,
            $this->unpaginatedPriceProductConcretePriceListSearchResourceMapper->mapRestSearchResponseToRestAttributesTransfer(
                ['sort' => $this->sortConfigTransferMock]
            )
        );
    }
}
