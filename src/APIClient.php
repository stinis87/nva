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
     * Last response.
     */
    private array $lastResponse = [];

    /**
     * Access token.
     */
    private string $accessToken = '';

    /**
     * Access token expiration.
     */
    private int $accessTokenExpiration;

    /**
     * Client id.
     */
    private string $clientId = '';

    /**
     * Client secret.
     */
    private string $clientSecret = '';

    /**
     * Token URL.
     */
    private string $tokenUrl = '';

    /**
     * HTTP client.
     */
    private Client $httpClient;

    /**
     * Results.
     */
    private array $results = [];

    public function __construct()
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../.env');
        $this->httpClient = new Client();
        $this->apiUrl = $_ENV['API_URL'];
    }

    /**
     * Authenticate.
     *
     * @return array|false
     */
    public function authenticate(): array|bool
    {
        $this->clientId = $_ENV['CLIENT_ID'];
        $this->clientSecret = $_ENV['CLIENT_SECRET'];
        $this->tokenUrl = $_ENV['TOKEN_URL'];
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
