<?php

namespace Stinis\Nva;

trait NvaPublicSearch
{
    /**
     * Search for publications.
     *
     * @param array $params
     * @return array
     */
    public function searchPublications($params): array
    {
        return $this->sendRequest('GET', 'search/resources', $params);
    }

    /**
     * Export publications.
     *
     * @param array $params
     * @return array
     */
    public function exportPublications($params): array
    {
        return $this->sendRequest('GET', 'search/resources/export', $params);
    }
}
