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
    private string $apiUrl;

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

    public function __construct()
    {
        $dotenv = new Dotenv();
        $envFilePath = $this->findEnvFile();
        if ($envFilePath) {
            $dotenv->load($envFilePath);
        } else {
            throw new \RuntimeException('Unable to locate .env file.');
        }
        if (empty($_ENV['API_URL'])) {
            throw new \RuntimeException('API_URL must be set in .env file.');
        }
        $this->httpClient = new Client();
        $this->apiUrl = $_ENV['API_URL'];
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
        if (empty($_ENV['CLIENT_ID'] || empty($_ENV['CLIENT_SECRET']))) {
            throw new \RuntimeException('CLIENT_ID and CLIENT_SECRET must be set in .env file.');
        }
        $params = [
            'grant_type' => 'client_credentials',
            'client_id' => $_ENV['CLIENT_ID'],
            'client_secret' => $_ENV['CLIENT_SECRET'],
        ];
        // Make a POST request to obtain access token
        $response = $this->httpClient->post($_ENV['TOKEN_URL'], [
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
            $requestOptions = [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
                'query' => $params,
            ];
            $response = $this->httpClient->$method(
                $this->apiUrl . $endpoint,
                $requestOptions,
            );
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            echo($e->getMessage());
            return false;
        }
    }
}
