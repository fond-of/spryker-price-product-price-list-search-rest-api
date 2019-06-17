<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\PriceProductPriceListSearch;

use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiConfig;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductAbstractPriceListSearchResourceMapperInterface;
use Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\Page;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class PriceProductAbstractPriceListSearchReader implements PriceProductAbstractPriceListSearchReaderInterface
{
    protected const DEFAULT_ITEMS_PER_PAGE = 12;
    protected const PARAMETER_NAME_PAGE = 'page';
    protected const PARAMETER_NAME_ITEMS_PER_PAGE = 'ipp';

    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface
     */
    protected $priceProductPriceListPageSearchClient;

    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductAbstractPriceListSearchResourceMapperInterface
     */
    protected $priceListSearchResourceMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface $priceProductPriceListPageSearchClient
     * @param \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\PriceProductAbstractPriceListSearchResourceMapperInterface $priceListSearchResourceMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface $priceProductPriceListPageSearchClient,
        PriceProductAbstractPriceListSearchResourceMapperInterface $priceListSearchResourceMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->priceProductPriceListPageSearchClient = $priceProductPriceListPageSearchClient;
        $this->priceListSearchResourceMapper = $priceListSearchResourceMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function search(RestRequestInterface $restRequest): RestResponseInterface
    {
        $searchString = $this->getRequestParameter(
            $restRequest,
            PriceProductPriceListSearchRestApiConfig::QUERY_STRING_PARAMETER
        );

        $requestParameters = $this->getAllRequestParameters($restRequest);

        $searchResult = $this->priceProductPriceListPageSearchClient->searchAbstract($searchString, $requestParameters);

        $restSearchAttributesTransfer = $this->priceListSearchResourceMapper
            ->mapRestSearchResponseToRestAttributesTransfer($searchResult);

        return $this->buildRestResponse($restRequest, $restSearchAttributesTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param string $parameterName
     *
     * @return string
     */
    protected function getRequestParameter(RestRequestInterface $restRequest, string $parameterName): string
    {
        return $restRequest->getHttpRequest()->query->get($parameterName, '');
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return array
     */
    protected function getAllRequestParameters(RestRequestInterface $restRequest): array
    {
        $params = $restRequest->getHttpRequest()->query->all();
        if ($restRequest->getPage()) {
            $params[static::PARAMETER_NAME_ITEMS_PER_PAGE] = $restRequest->getPage()->getLimit();
            $params[static::PARAMETER_NAME_PAGE] = ($restRequest->getPage()->getOffset() / $restRequest->getPage()->getLimit()) + 1;
        }

        return $params;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestPriceProductPriceListSearchAttributesTransfer $restPriceProductPriceListSearchAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function buildRestResponse(
        RestRequestInterface $restRequest,
        RestPriceProductPriceListSearchAttributesTransfer $restPriceProductPriceListSearchAttributesTransfer
    ): RestResponseInterface {
        $restResource = $this->restResourceBuilder->createRestResource(
            PriceProductPriceListSearchRestApiConfig::RESOURCE_PRICE_PRODUCT_ABSTRACT_PRICE_LIST_SEARCH,
            null,
            $restPriceProductPriceListSearchAttributesTransfer
        );

        $response = $this->restResourceBuilder->createRestResponse(
            $restPriceProductPriceListSearchAttributesTransfer->getPagination()->getNumFound()
        );

        if (!$restRequest->getPage()) {
            $restRequest->setPage(new Page(0, static::DEFAULT_ITEMS_PER_PAGE));
        }

        return $response->addResource($restResource);
    }
}
