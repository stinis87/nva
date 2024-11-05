NVA (Nasjonaltiv vitenarkiv) API Client designed to interact with the NVA API. It provides a simple and efficient way to authenticate and make requests to these APIs, allowing you to search for publications and other related data.

Getting started:

composer require stinis87/nva

use Stinis\Nva\APIClient;

$apiClient = new \Stinis\Nva\APIClient();

$auth = $apiClient->authenticate();

$results = $apiClient->getCristinCategories();

// Make sure to set the following environment variables inside your .env file:

CLIENT_ID=__client_id__
CLIENT_SECRET=__client_secret
TOKEN_URL=__token_url__
API_URL=__api_url__

