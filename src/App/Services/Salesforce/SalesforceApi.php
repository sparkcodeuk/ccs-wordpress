<?php

declare(strict_types=1);

namespace App\Services\Salesforce;

use GuzzleHttp\Client;

/**
 * Class SalesforceApi
 * @package App\Services\Salesforce
 */
class SalesforceApi
{

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;


    /**
     * @var \GuzzleHttp\Psr7\Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $headers;

    /**
     * SalesforceApi constructor.
     */
    public function __construct()
    {
        $this->initClient();
        $this->setupHeaders();
    }

    /**
     * Set up the client initally
     */
    protected function initClient()
    {
        $this->client = new Client(['base_uri' => getenv('SALESFORCE_INSTANCE_URL') . 'services/data/' . getenv('SALESFORCE_API_VERSION') . '/']);
    }

    /**
     * Configure the required headers
     */
    protected function setupHeaders()
    {
        $this->headers = [
          'Authorization' => 'Bearer ' . getenv('SALESFORCE_ACCESS_TOKEN')
        ];
    }

    public function generateToken()
    {
        $client = new Client(['base_uri' => getenv('SALESFORCE_INSTANCE_URL') . 'services/']);

        $queryParams = [
          'grant_type'    => 'password',
          'client_id'     => getenv('SALESFORCE_CLIENT_ID'),
          'client_secret' => getenv('SALESFORCE_CLIENT_SECRET'),
          'username'      => getenv('SALESFORCE_USERNAME'),
          'password'      => getenv('SALESFORCE_PASSWORD') . getenv('SALESFORCE_SECURITY_TOKEN'),
        ];

        $this->response = $client->request('POST', 'oauth2/token', [
          'query'   => $queryParams,
          'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
        ]);

        return $this->getResponseContent();
    }

    /**
     * @param string $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function query($query)
    {
        $queryParams = [
          'q' => $query,
        ];

        $this->response = $this->client->request('GET', 'query', [
          'query'   => $queryParams,
          'headers' => $this->headers,
        ]);

        return $this->getResponseContent();
    }

    /**
     * @param bool $json
     * @return mixed
     * @throws \Exception
     */
    public function getResponseContent($json = false)
    {
        if ($this->response->getStatusCode() != 200) {
            throw new \Exception('Response has no content. Response status code: ' . $this->response->getStatusCode() . ' Response Error Message: ' . $this->response->getReasonPhrase());
        }

        $contents = $this->response->getBody()->getContents();

        if ($json == true)
        {
            return $contents;
        }

        return json_decode($contents);
    }

    /**
     * @param $frameworkId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFramework($frameworkId)
    {
        $this->response = $this->client->request('GET', 'sobjects/Master_Framework__c/' . $frameworkId, [
          'headers' => $this->headers,
        ]);

        return $this->getResponseContent();
    }


    /**
     * @param $lotId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLot($lotId)
    {
        $this->response = $this->client->request('GET', 'sobjects/Master_Framework_Lot__c/' . $lotId, [
          'headers' => $this->headers,
        ]);

        return $this->getResponseContent();
    }


    /**
     * @param $supplierId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSupplier($supplierId)
    {
        $this->response = $this->client->request('GET', 'sobjects/Master_Framework_Lot_Contact__c/' . $supplierId, [
          'headers' => $this->headers,
        ]);

        return $this->getResponseContent();
    }

    /**
     * @param $accountId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccount($accountId)
    {
        $this->response = $this->client->request('GET', 'sobjects/Account/' . $accountId, [
          'headers' => $this->headers,
        ]);

        return $this->getResponseContent();
    }


    /**
     * @param $categoryId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCategory($categoryId)
    {
        $this->response = $this->client->request('GET', 'sobjects/Category__c/' . $categoryId, [
          'headers' => $this->headers,
        ]);

        return $this->getResponseContent();
    }


}