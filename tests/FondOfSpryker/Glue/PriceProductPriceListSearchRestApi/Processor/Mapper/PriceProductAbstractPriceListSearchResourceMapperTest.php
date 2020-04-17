<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer;
use Generated\Shared\Transfer\SortConfigTransfer;

class PriceProductAbstractPriceListSearchResourceMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductAbstractPriceListSearchResourceMapper
     */
    protected $priceProductAbstractPriceListSearchResourceMapper;

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
            'price_product_abstract_price_lists' => [
                [],
            ],
            'sort' => $this->sortConfigTransferMock,
        ];

        $this->priceProductAbstractPriceListSearchResourceMapper = new PriceProductAbstractPriceListSearchResourceMapper();
    }

    /**
     * @return void
     */
    public function testGetPricesSearchKey(): void
    {
        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->assertInstanceOf(
            RestPriceProductPriceListSearchAttributesTransfer::class,
            $this->priceProductAbstractPriceListSearchResourceMapper->mapRestSearchResponseToRestAttributesTransfer(
                $this->restSearchResponse
            )
        );
    }

    /**
     * @return void
     */
    public function testGetPricesSearchKeyNoArray(): void
    {
        $this->sortConfigTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->assertInstanceOf(
            RestPriceProductPriceListSearchAttributesTransfer::class,
            $this->priceProductAbstractPriceListSearchResourceMapper->mapRestSearchResponseToRestAttributesTransfer(
                ['sort' => $this->sortConfigTransferMock]
            )
        );
    }
}
