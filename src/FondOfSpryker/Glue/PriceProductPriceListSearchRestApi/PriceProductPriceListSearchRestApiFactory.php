<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi;

use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductAbstractPriceListSearchResourceMapper;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductConcretePriceListSearchResourceMapper;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductPriceListSearchResourceMapperInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductAbstractPriceListSearchReader;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductConcretePriceListSearchReader;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductPriceListSearchReaderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class PriceProductPriceListSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductPriceListSearchReaderInterface
     */
    public function createPriceProductConcretePriceListSearchReader(): PriceProductPriceListSearchReaderInterface
    {
        return new PriceProductConcretePriceListSearchReader(
            $this->getPriceProductPriceListPageSearchClient(),
            $this->createPriceProductConcretePriceListSearchResourceMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductPriceListSearchReaderInterface
     */
    public function createPriceProductAbstractPriceListSearchReader(): PriceProductPriceListSearchReaderInterface
    {
        return new PriceProductAbstractPriceListSearchReader(
            $this->getPriceProductPriceListPageSearchClient(),
            $this->createPriceProductAbstractPriceListSearchResourceMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductPriceListSearchResourceMapperInterface
     */
    protected function createPriceProductConcretePriceListSearchResourceMapper(): PriceProductPriceListSearchResourceMapperInterface
    {
        return new PriceProductConcretePriceListSearchResourceMapper();
    }

    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductPriceListSearchResourceMapperInterface
     */
    protected function createPriceProductAbstractPriceListSearchResourceMapper(): PriceProductPriceListSearchResourceMapperInterface
    {
        return new PriceProductAbstractPriceListSearchResourceMapper();
    }

    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface
     */
    protected function getPriceProductPriceListPageSearchClient(): PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListSearchRestApiDependencyProvider::CLIENT_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH);
    }
}
