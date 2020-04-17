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

        $this->unpaginatedPriceProductAbstractPriceListSearchResourceMapper = new UnpaginatedPriceProductAbstractPriceListSearchResourceMapper();
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
            $this->unpaginatedPriceProductAbstractPriceListSearchResourceMapper->mapRestSearchResponseToRestAttributesTransfer(
                $this->restSearchResponse
            )
        );
    }
}
