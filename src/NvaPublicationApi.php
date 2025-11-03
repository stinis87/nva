<?php

namespace Stinis\Nva;

trait NvaPublicationApi
{
    /**
     * Get a list of publications by owner.
     *
     * @return array
     */
    public function getPublicationByOwner(): array|false
    {
        return $this->sendRequest('GET', 'publication/by-owner');
    }

    /**
     * Delete a publication by UUID.
     *
     * @return array|false
     */
    public function deletePublicationByUuid(string $uuid): array|false
    {
        return $this->sendRequest('DELETE', 'publication/' . $uuid);
    }

    /**
     * Update a publication by UUID.
     *
     * @return array|false
     */
    public function updatePublicationByUuid(string $uuid): array|false
    {
        return $this->sendRequest('PUT', 'publication/' . $uuid);
    }

    /**
     * Get a publication by UUID.
     *
     * @return array|false
     */
    public function getPublicationByUuid($uuid): array|false
    {
        return $this->sendRequest('GET', 'publication/' . $uuid);
    }

    /**
     * Get publication context.
     *
     * @return array|false
     */
    public function getPublicationContext(): array|false
    {
        return $this->sendRequest('GET', 'publication/context');
    }
}
