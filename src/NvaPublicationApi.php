<?php

namespace Stinis\Nva;

trait NvaPublicationApi
{
    /**
     * Get a list of publications by owner.
     *
     * @return array
     */
    public function getPublicationByOwner(): array
    {
        return $this->sendRequest('GET', 'publication/by-owner');
    }

    /**
     * Delete a publication by UUID.
     *
     * @return array
     */
    public function deletePublicationByUuid(string $uuid): array
    {
        return $this->sendRequest('DELETE', 'publication/' . $uuid);
    }

    /**
     * Update a publication by UUID.
     *
     * @return array
     */
    public function updatePublicationByUuid(string $uuid): array
    {
        return $this->sendRequest('PUT', 'publication/' . $uuid);
    }

    /**
     * Get a publication by UUID.
     *
     * @return array
     */
    public function getPublicationByUuid($uuid): array
    {
        return $this->sendRequest('GET', 'publication/' . $uuid);
    }

    /**
     * Get publication context.
     *
     * @return array
     */
    public function getPublicationContext(): array
    {
        return $this->sendRequest('GET', 'publication/context');
    }
}
