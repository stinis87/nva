<?php

namespace Stinis\Nva;

use GuzzleHttp\Client;
use Symfony\Component\Dotenv\Dotenv;

class APIClient
{
    use NvaPublicSearch;
    use NvaPublicationApi;
    use CristinRequests;

    /**
     * API URL.
     */
    private const API_URL = 'https://api.nva.unit.no/';

    private const TOKEN_URL = 'https://nva-test-ext.auth.eu-west-1.amazoncognito.com/oauth2/token';

    /**
     * Access token.
     */
    private string $accessToken = '';

    /**
     * Access token expiration.
     */
    private int $accessTokenExpiration;

    /**
     * HTTP client.
     */
    private Client $httpClient;

    /**
     * Client ID.
     */
    private string $clientId;

    /**
     * Client secret.
     */
    private string $clientSecret;

    /**
     * API URL.
     */
    private string $apiUrl;

    /**
     * Token URL.
     */
    private string $tokenUrl;

    /**
     * Custom headers for API requests.
     */
    private array $customHeaders = [];

    public function __construct(?string $clientId = null, ?string $clientSecret = null, ?string $apiUrl = null, ?string $tokenUrl = null)
    {
        $this->apiUrl = $apiUrl ?? self::API_URL;
        $this->tokenUrl = $tokenUrl ?? self::TOKEN_URL;
        if ($clientId && $clientSecret) {
            $this->clientId = $clientId;
            $this->clientSecret = $clientSecret;
        }
        $this->httpClient = new Client();
    }

    /**
     * Find .env file.
     *
     * @return string|null
     */
    private function findEnvFile(): ?string
    {
        $currentDir = __DIR__;
        while ($currentDir !== dirname($currentDir)) {
            $envFilePath = $currentDir . '/.env';
            if (file_exists($envFilePath)) {
                return $envFilePath;
            }
            $currentDir = dirname($currentDir);
        }
        return null;
    }

    /**
     * Authenticate.
     *
     * @return array|false
     */
    public function authenticate(): array|bool
    {
        if (empty($this->clientId) || empty($this->clientSecret)) {
            throw new \RuntimeException('CLIENT_ID and CLIENT_SECRET must be set.');
        }
        $params = [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
        // Make a POST request to obtain access token
        $response = $this->httpClient->post($this->tokenUrl, [
            'form_params' => $params,
        ]);
        if ($response->getStatusCode() !== 200) {
            return false;
        }
        $data = json_decode($response->getBody()->getContents(), true);
        if (isset($data['access_token'])) {
            $this->accessToken = $data['access_token'];
            $this->accessTokenExpiration = time() + $data['expires_in'];
        }
        return $data;
    }

    /**
     * Set the API base URL (e.g., for Gravitee).
     *
     * @param string $apiUrl
     */
    public function setApiUrl(string $apiUrl): void
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * Set the Token URL.
     *
     * @param string $tokenUrl
     */
    public function setTokenUrl(string $tokenUrl): void
    {
      $this->tokenUrl = $tokenUrl;
    }

    /**
     * Set custom headers (e.g., for Gravitee).
     *
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->customHeaders = $headers;
    }

    /**
     * Send request.
     *
     * @param string $method
     * @param string $endpoint
     * @param array $params
     *
     * @return array|false
     */
    public function sendRequest(string $method, string $endpoint, array $params = ['results' => 50]): array|false
    {
        try {
            if (!isset($this->customHeaders['X-Gravitee-Api-Key'])) {
                $this->setHeaders(['Authorization' => 'Bearer ' . $this->accessToken]);
            }
            $requestOptions = [
                'headers' => $this->customHeaders,
                'query' => $params,
            ];
            $response = $this->httpClient->$method(
                $this->apiUrl . $endpoint,
                $requestOptions
            );
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            echo($e->getMessage());
            return false;
        }
    }
}
