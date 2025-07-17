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
     * @return array
     */
    public function getCristinPersonByOrganization(string $id, $params = []): array
    {
        return $this->sendRequest('get', 'cristin/organization/' . $id . '/persons', $params);
    }

    /**
     * Get Cristin organization by ID.
     *
     * @param string $id
     * @param array $params
     *
     * @return array
     */
    public function getCristinOrganization(string $id, $params = []): array
    {
        return $this->sendRequest('get', 'cristin/organization/' . $id, $params);
    }

    /**
     * Get Cristin organization by query parameters.
     *
     * @param array $params
     *
     * @return array
     */
    public function getCristinOrganizationByQueryParameters(array $params): array
    {
        return $this->sendRequest('get', 'cristin/organization', $params);
    }

    /**
     * Get Cristin supported countries.
     *
     * @return array
     */
    public function getCristinSupportedCountries(): array
    {
        return $this->sendRequest('get', 'cristin/country');
    }

    /**
     * Get Cristin funding sources.
     *
     * @return array
     */
    public function getCristinFundingSources(): array
    {
        return $this->sendRequest('get', 'cristin/funding-sources');
    }

    /**
     * Get Cristin funding source by ID.
     *
     * @param string $id
     *
     * @return array
     */
    public function getCristinFundingSourceById(string $id): array
    {
        return $this->sendRequest('get', 'cristin/funding-sources/' . $id);
    }

    /**
     * Get Cristin project by ID.
     *
     * @param string $id
     * @return array
     */
    public function getCristinProjectById(string $id): array
    {
        // Pass empty query params here since endpoint does not support any.
        return $this->sendRequest('get', 'cristin/project/' . $id, []);
    }

    /**
     * Get Cristin project by query parameters.
     *
     * @param array $params
     * @return array
     */
    public function getCristinProjectByQueryParameters(array $params): array
    {
        return $this->sendRequest('get', 'cristin/project/', $params);
    }

    /**
     * Get Cristin person by ID.
     *
     * @param string $id
     * @return array
     */
    public function getCristinPersonById(string $id): array
    {
        // Pass empty query params here since endpoint does not support any.
        return $this->sendRequest('get', 'cristin/person/' . $id, []);
    }

    /**
     * Get Cristin person by query parameters.
     *
     * @param array $params
     * @return array
     */
    public function getCristinPersonByQueryParameters(array $params): array
    {
        return $this->sendRequest('get', 'cristin/person/', $params);
    }

    /**
     * Get Cristin keywords by id.
     *
     * @param string $id
     * @return array
     */
    public function getCristinKeywordById(string $id): array
    {
        return $this->sendRequest('get', 'cristin/keyword/' . $id);
    }

    /**
     * Get Cristin keywords.
     *
     * @param array $params
     * @return array
     */
    public function getCristinKeywords($params = []): array
    {
        return $this->sendRequest('get', 'cristin/keyword', $params);
    }

    /**
     * Get Cristin categories.
     *
     * @return array
     */
    public function getCristinCategories(): array
    {
        return $this->sendRequest('get', 'cristin/category/project');
    }

    /**
     * Get Cristin projects by organization ID.
     *
     * @param string $id
     * @param array $params
     * @return array
     */
    public function getCristinProjectsByOrganization(string $id, $params = []): array
    {
        return $this->sendRequest('get', 'cristin/organization/' . $id . '/projects', $params);
    }
}
