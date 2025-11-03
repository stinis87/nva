<?php

namespace Stinis\Nva;

trait NvaPublicSearch
{
    /**
     * Search for publications.
     *
     * @param array $params
     * @return array|false
     */
    public function searchPublications(array $params): array|false
    {
        return $this->sendRequest('GET', 'search/resources', $params);
    }

    /**
     * Export publications.
     *
     * @param array $params
     * @return array|false
     */
    public function exportPublications(array $params): array|false
    {
        return $this->sendRequest('GET', 'search/resources/export', $params);
    }
}
