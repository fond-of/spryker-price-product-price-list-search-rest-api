<?php

namespace FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\UnpaginatedPriceProductPriceListSearch;

use Exception;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Exception\ArrayKeyDoesNotExistException;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Exception\InvalidInstanceTypeException;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\PriceProductPriceListSearchRestApiConfig;
use FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\UnpaginatedPriceProductPriceListSearchResourceMapperInterface;
use Generated\Shared\Transfer\PaginationSearchResultTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractUnpaginatedPriceProductPriceListSearchReader implements UnpaginatedPriceProductPriceListSearchReaderInterface
{
    protected const PARAMETER_NAME_PAGE = 'page';
    protected const PARAMETER_NAME_ITEMS_PER_PAGE = 'ipp';

    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface
     */
    protected $priceProductPriceListPageSearchClient;

    /**
     * @var \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\UnpaginatedPriceProductPriceListSearchResourceMapperInterface
     */
    protected $unpaginatedPriceProductPriceListSearchResourceMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Dependency\Client\PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface $priceProductPriceListPageSearchClient
     * @param \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Processor\Mapper\UnpaginatedPriceProductPriceListSearchResourceMapperInterface $unpaginatedPriceProductPriceListSearchResourceMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        PriceProductPriceListSearchRestApiToPriceProductPriceListPageSearchClientInterface $priceProductPriceListPageSearchClient,
        UnpaginatedPriceProductPriceListSearchResourceMapperInterface $unpaginatedPriceProductPriceListSearchResourceMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->priceProductPriceListPageSearchClient = $priceProductPriceListPageSearchClient;
        $this->unpaginatedPriceProductPriceListSearchResourceMapper = $unpaginatedPriceProductPriceListSearchResourceMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function unpaginatedSearch(RestRequestInterface $restRequest): RestResponseInterface
    {
        $searchString = $this->getRequestParameter($restRequest, PriceProductPriceListSearchRestApiConfig::QUERY_STRING_PARAMETER);
        $requestParameters = $this->getAllRequestParameters($restRequest);

        try {
            $searchResult = $this->search($searchString, $requestParameters);
        } catch (Exception $e) {
            return $this->buildErrorResponse($e);
        }

        $restSearchAttributesTransfer = $this->unpaginatedPriceProductPriceListSearchResourceMapper
            ->mapRestSearchResponseToRestAttributesTransfer($searchResult);

        return $this->buildRestResponse($restSearchAttributesTransfer);
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

        $params[static::PARAMETER_NAME_ITEMS_PER_PAGE] = 1000; // TODO: configurable

        return $params;
    }

    /**
     * @param string $searchString
     * @param array $requestParameters
     *
     * @throws
     *
     * @return array
     */
    protected function search(string $searchString, array $requestParameters = []): array
    {
        $searchResult = $this->doSearch($searchString, $requestParameters);

        $this->validateSearchResult($searchResult);

        /** @var \Generated\Shared\Transfer\PaginationSearchResultTransfer $pagination */
        $pagination = $searchResult['pagination'];

        if ($pagination->getCurrentPage() === $pagination->getMaxPage()) {
            return $searchResult;
        }

        $requestParameters[static::PARAMETER_NAME_PAGE] = $pagination->getCurrentPage() + 1;
        $searchResultToMerge = $this->search($searchString, $requestParameters);

        if (count($searchResultToMerge['prices']) === 0) {
            return $searchResult;
        }

        $searchResult['prices'] = array_merge($searchResult['prices'], $searchResultToMerge['prices']);

        return $searchResult;
    }

    /**
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     */
    abstract protected function doSearch(string $searchString, array $requestParameters = []): array;

    /**
     * @param \Generated\Shared\Transfer\RestUnpaginatedPriceProductPriceListSearchAttributesTransfer $restSearchAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    abstract protected function buildRestResponse(
        RestUnpaginatedPriceProductPriceListSearchAttributesTransfer $restSearchAttributesTransfer
    ): RestResponseInterface;

    /**
     * @param array $searchResult
     *
     * @throws \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Exception\ArrayKeyDoesNotExistException
     * @throws \FondOfSpryker\Glue\PriceProductPriceListSearchRestApi\Exception\InvalidInstanceTypeException
     *
     * @return void
     */
    protected function validateSearchResult(array $searchResult): void
    {
        if (!array_key_exists('pagination', $searchResult)) {
            throw new ArrayKeyDoesNotExistException('Pagination is missing.');
        }

        if (!($searchResult['pagination'] instanceof PaginationSearchResultTransfer)) {
            throw new InvalidInstanceTypeException('Wrong instance for pagination.');
        }

        if (!array_key_exists('prices', $searchResult)) {
            throw new ArrayKeyDoesNotExistException('Prices are missing');
        }
    }

    /**
     * @param \Exception $exception
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function buildErrorResponse(Exception $exception): RestResponseInterface
    {
        $response = $this->restResourceBuilder->createRestResponse();

        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode($exception->getCode())
            ->setStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->setDetail($exception->getMessage());

        return $response->addError($restErrorTransfer);
    }
}
