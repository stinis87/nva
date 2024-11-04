<?php

namespace Stinis\Nva;

trait NvaPublicSearch
{
    public function searchPublications($params)
    {
        return $this->sendRequest('GET', 'search/resources', $params);
    }

    public function exportPublications($params)
    {
        return $this->sendRequest('GET', 'search/resources/export', $params);
    }

}
