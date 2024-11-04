<?php

namespace Stinis\Nva;

trait NvaPublicationApi
{
    public function getPublicationByOwner()
    {
        return $this->sendRequest('GET', 'publication/by-owner');
    }

    public function deletePublicationByUuid(string $uuid)
    {
        return $this->sendRequest('DELETE', 'publication/' . $uuid);
    }

    public function updatePublicationByUuid(string $uuid)
    {
        return $this->sendRequest('PUT', 'publication/' . $uuid);
    }

    public function getPublicationByUuid($uuid)
    {
        return $this->sendRequest('GET', 'publication/' . $uuid);
    }

    public function getPublicationContext()
    {
        return $this->sendRequest('GET', 'publication/context');
    }
}
