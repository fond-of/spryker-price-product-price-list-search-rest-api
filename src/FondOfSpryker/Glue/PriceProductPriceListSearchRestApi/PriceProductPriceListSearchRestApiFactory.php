<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi;

use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductAbstractPriceListSearchResourceMapper;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductConcretePriceListSearchResourceMapper;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductPriceListSearchResourceMapperInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\UnpaginatedPriceProductAbstractPriceListSearchResourceMapper;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\UnpaginatedPriceProductConcretePriceListSearchResourceMapper;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\UnpaginatedPriceProductPriceListSearchResourceMapperInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductAbstractPriceListSearchReader;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductConcretePriceListSearchReader;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch\PriceProductPriceListSearchReaderInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch\UnpaginatedPriceProductAbstractPriceListSearchReader;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch\UnpaginatedPriceProductConcretePriceListSearchReader;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch\UnpaginatedPriceProductPriceListSearchReaderInterface;
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
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch\UnpaginatedPriceProductPriceListSearchReaderInterface
     */
    public function createUnpaginatedPriceProductConcretePriceListSearchReader(): UnpaginatedPriceProductPriceListSearchReaderInterface
    {
        return new UnpaginatedPriceProductConcretePriceListSearchReader(
            $this->getPriceProductPriceListPageSearchClient(),
            $this->createUnpaginatedPriceProductConcretePriceListSearchResourceMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch\UnpaginatedPriceProductPriceListSearchReaderInterface
     */
    public function createUnpaginatedPriceProductAbstractPriceListSearchReader(): UnpaginatedPriceProductPriceListSearchReaderInterface
    {
        return new UnpaginatedPriceProductAbstractPriceListSearchReader(
            $this->getPriceProductPriceListPageSearchClient(),
            $this->createUnpaginatedPriceProductAbstractPriceListSearchResourceMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\UnpaginatedPriceProductPriceListSearchResourceMapperInterface
     */
    protected function createUnpaginatedPriceProductConcretePriceListSearchResourceMapper(): UnpaginatedPriceProductPriceListSearchResourceMapperInterface
    {
        return new UnpaginatedPriceProductConcretePriceListSearchResourceMapper();
    }

    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\UnpaginatedPriceProductPriceListSearchResourceMapperInterface
     */
    protected function createUnpaginatedPriceProductAbstractPriceListSearchResourceMapper(): UnpaginatedPriceProductPriceListSearchResourceMapperInterface
    {
        return new UnpaginatedPriceProductAbstractPriceListSearchResourceMapper();
    }

    /**
     * @return \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface
     */
    protected function getPriceProductPriceListPageSearchClient(): PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface
    {
        return $this->getProvidedDependency(PriceProductPriceListSearchRestApiDependencyProvider::CLIENT_PRICE_PRODUCT_PRICE_LIST_PAGE_SEARCH);
    }
}
