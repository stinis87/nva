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
    private const API_URL = 'https://api.test.nva.aws.unit.no/';

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

    private string $clientId;
    private string $clientSecret;
    private string $apiUrl;

    private array $customHeaders = [];

    public function __construct(?string $clientId = null, ?string $clientSecret = null, ?string $apiUrl = null)
    {
        if ($clientId && $clientSecret) {
            $this->clientId = $clientId;
            $this->clientSecret = $clientSecret;
        } else {
            $dotenv = new Dotenv();
            $envFilePath = $this->findEnvFile();
            if ($envFilePath) {
                $dotenv->load($envFilePath);
            } else {
                throw new \RuntimeException('Unable to locate .env file.');
            }
            $this->clientId = $_ENV['CLIENT_ID'] ?? '';
            $this->clientSecret = $_ENV['CLIENT_SECRET'] ?? '';
        }
        $this->httpClient = new Client();
        $this->apiUrl = $apiUrl ?? 'https://api.nva.unit.no/';
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
        $response = $this->httpClient->post(self::TOKEN_URL, [
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
            $headers = array_merge([
                'Authorization' => 'Bearer ' . $this->accessToken,
            ], $this->customHeaders);
            $requestOptions = [
                'headers' => $headers,
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
