<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi;

use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductAbstractPriceListSearchResourceMapper;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductAbstractPriceListSearchResourceMapperInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductConcretePriceListSearchResourceMapper;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductConcretePriceListSearchResourceMapperInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductAbstractPriceListSearchReader;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductAbstractPriceListSearchReaderInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductConcretePriceListSearchReader;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductConcretePriceListSearchReaderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class PriceProductPriceListSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductConcretePriceListSearchReaderInterface
     */
    public function createPriceProductConcretePriceListSearchReader(): PriceProductConcretePriceListSearchReaderInterface
    {
        return new PriceProductConcretePriceListSearchReader(
            $this->getPriceProductPriceListPageSearchClient(),
            $this->createPriceProductConcretePriceListSearchMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductAbstractPriceListSearchReaderInterface
     */
    public function createPriceProductAbstractPriceListSearchReader(): PriceProductAbstractPriceListSearchReaderInterface
    {
        return new PriceProductAbstractPriceListSearchReader(
            $this->getPriceProductPriceListPageSearchClient(),
            $this->createPriceProductAbstractPriceListSearchMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductConcretePriceListSearchResourceMapperInterface
     */
    protected function createPriceProductConcretePriceListSearchMapper(): PriceProductConcretePriceListSearchResourceMapperInterface
    {
        return new PriceProductConcretePriceListSearchResourceMapper();
    }

    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductAbstractPriceListSearchResourceMapperInterface
     */
    protected function createPriceProductAbstractPriceListSearchMapper(): PriceProductAbstractPriceListSearchResourceMapperInterface
    {
        return new PriceProductAbstractPriceListSearchResourceMapper();
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface
     */
    protected function getPriceProductPriceListPageSearchClient(): PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListSearchRestApiDependencyProvider::CLIENT_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH);
    }
}
