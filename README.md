NVA (Nasjonaltiv vitenarkiv) API Client designed to interact with the NVA API. It provides a simple and efficient way to make requests to this API, allowing you to search for publications, persons and other related data.

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

