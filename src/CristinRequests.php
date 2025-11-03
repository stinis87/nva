<?php

namespace Stinis\Nva;

trait CristinRequests
{

    /**
     * Get Cristin person by organization ID.
     *
     * @param string $id
     * @param array $params
     *
     * @return array|false
     */
    public function getCristinPersonByOrganization(string $id, $params = []): array|false
    {
        return $this->sendRequest('get', 'cristin/organization/' . $id . '/persons', $params);
    }

    /**
     * Get Cristin organization by ID.
     *
     * @param string $id
     * @param array $params
     *
     * @return array|false
     */
    public function getCristinOrganization(string $id, $params = []): array|false
    {
        return $this->sendRequest('get', 'cristin/organization/' . $id, $params);
    }

    /**
     * Get Cristin organization by query parameters.
     *
     * @param array $params
     *
     * @return array|false
     */
    public function getCristinOrganizationByQueryParameters(array $params): array|false
    {
        return $this->sendRequest('get', 'cristin/organization', $params);
    }

    /**
     * Get Cristin supported countries.
     *
     * @return array|false
     */
    public function getCristinSupportedCountries(): array|false
    {
        return $this->sendRequest('get', 'cristin/country');
    }

    /**
     * Get Cristin funding sources.
     *
     * @return array|false
     */
    public function getCristinFundingSources(): array|false
    {
        return $this->sendRequest('get', 'cristin/funding-sources');
    }

    /**
     * Get Cristin funding source by ID.
     *
     * @param string $id
     *
     * @return array|false
     */
    public function getCristinFundingSourceById(string $id): array|false
    {
        return $this->sendRequest('get', 'cristin/funding-sources/' . $id);
    }

    /**
     * Get Cristin project by ID.
     *
     * @param string $id
     * @return array|false
     */
    public function getCristinProjectById(string $id): array|false
    {
        // Pass empty query params here since endpoint does not support any.
        return $this->sendRequest('get', 'cristin/project/' . $id, []);
    }

    /**
     * Get Cristin project by query parameters.
     *
     * @param array $params
     * @return array|false
     */
    public function getCristinProjectByQueryParameters(array $params): array|false
    {
        return $this->sendRequest('get', 'cristin/project/', $params);
    }

    /**
     * Get Cristin person by ID.
     *
     * @param string $id
     * @return array|false
     */
    public function getCristinPersonById(string $id): array|false
    {
        // Pass empty query params here since endpoint does not support any.
        return $this->sendRequest('get', 'cristin/person/' . $id, []);
    }

    /**
     * Get Cristin person by query parameters.
     *
     * @param array $params
     * @return array|false
     */
    public function getCristinPersonByQueryParameters(array $params): array|false
    {
        return $this->sendRequest('get', 'cristin/person/', $params);
    }

    /**
     * Get Cristin keywords by id.
     *
     * @param string $id
     * @return array|false
     */
    public function getCristinKeywordById(string $id): array|false
    {
        return $this->sendRequest('get', 'cristin/keyword/' . $id);
    }

    /**
     * Get Cristin keywords.
     *
     * @param array $params
     * @return array|false
     */
    public function getCristinKeywords($params = []): array|false
    {
        return $this->sendRequest('get', 'cristin/keyword', $params);
    }

    /**
     * Get Cristin categories.
     *
     * @return array|false
     */
    public function getCristinCategories(): array|false
    {
        return $this->sendRequest('get', 'cristin/category/project');
    }

    /**
     * Get Cristin projects by organization ID.
     *
     * @param string $id
     * @param array $params
     * @return array|false
     */
    public function getCristinProjectsByOrganization(string $id, $params = []): array|false
    {
        return $this->sendRequest('get', 'cristin/organization/' . $id . '/projects', $params);
    }
}
