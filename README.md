> NVA (Nasjonaltiv vitenarkiv) API Client designed to interact with the NVA API.
> It provides a simple and efficient way to make requests to this API, allowing you to search for publications, 
> persons and other related data.

Examples of usages include:

- Get all Cristin categories
- Get Cristin person by organization
- Get Cristin organization
- Get Cristin organization by query parameters
- Get Cristin supported countries
- Get Cristin funding sources
- Get Cristin funding source by id
- Get Cristin project by id
- Get Cristin project by query parameters
- Get Cristin person by id
- Get Cristin person by query parameters
- Get Cristin keyword by id
- Get Cristin keywords
- Get Cristin projects by organization
- Search publications
- Export publications

Installation
============

Official installation method is via composer.

```
$ composer require stinis87/nva
```

Usage
=====

An example of usage would be as follows:

```php
<?php

use Stinis\Nva\APIClient;

$apiClient = new \Stinis\Nva\APIClient();
$results = $apiClient->getCristinCategories();

```

Pre-requisites
=====================

Make sure to set the following environment variables inside your .env file:

```
CLIENT_ID=__client_id__
Client_SECRET=__client_secret__
```

