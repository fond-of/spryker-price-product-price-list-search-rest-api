<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface UnpaginatedPriceProductPriceListSearchReaderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function unpaginatedSearch(RestRequestInterface $restRequest): RestResponseInterface;
}
