<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Controller;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiFactory getFactory()
 */
class UnpaginatedPriceProductAbstractPriceListSearchResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->getFactory()
            ->createUnpaginatedPriceProductAbstractPriceListSearchReader()
            ->unpaginatedSearch($restRequest);
    }
}
