<?php

namespace Stinis\Nva;

trait CristinRequests
{
    public function getCristinPersonByOrganization(string $id, $params = [])
    {
        return $this->sendRequest('get', 'cristin/organization/' . $id . '/persons', $params);
    }

    public function getCristinOrganization(string $id, $params = [])
    {
        return $this->sendRequest('get', 'cristin/organization/' . $id, $params);
    }

    public function getCristinOrganizationByQueryParameters(array $params = [])
    {
        if (empty($params)) {
            return 'It is required to provide query parameters for this endpoint.';
        }
        return $this->sendRequest('get', 'cristin/organization', $params);
    }

    public function getCristinSupportedCountries()
    {
        return $this->sendRequest('get', 'cristin/country');
    }

    public function getCristinFundingSources()
    {
        return $this->sendRequest('get', 'cristin/funding-sources');
    }

    public function getCristinFundingSourceById(string $id)
    {
        return $this->sendRequest('get', 'cristin/funding-sources/' . $id);
    }

    public function getCristinProjectById(string $id)
    {
        // Pass empty query params here since endpoint does not support any.
        return $this->sendRequest('get', 'cristin/project/' . $id, []);
    }

    public function getCristinProjectByQueryParameters(array $params)
    {
        if (empty($params)) {
            return 'It is required to provide query parameters for this endpoint.';
        }
        return $this->sendRequest('get', 'cristin/project/', $params);
    }

    public function getCristinPersonById(string $id)
    {
        // Pass empty query params here since endpoint does not support any.
        return $this->sendRequest('get', 'cristin/person/' . $id, []);
    }

    public function getCristinPersonByQueryParameters(array $params = [])
    {
        if (empty($params)) {
            return 'It is required to provide query parameters for this endpoint.';
        }
        return $this->sendRequest('get', 'cristin/person/', $params);
    }

    public function getCristinKeywordById(string $id)
    {
        return $this->sendRequest('get', 'cristin/keyword/' . $id);
    }

    public function getCristinKeywords($params = [])
    {
        return $this->sendRequest('get', 'cristin/keyword', $params);
    }

    public function getCristinCategories()
    {
        return $this->sendRequest('get', 'cristin/category/project');
    }

    public function getCristinProjectsByOrganization(string $id, $params = [])
    {
        return $this->sendRequest('get', 'cristin/organization/' . $id . '/projects', $params);
    }
}
