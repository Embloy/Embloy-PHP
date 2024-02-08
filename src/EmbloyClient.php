<?php

namespace Embloy;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class EmbloyClient {
    private $clientToken;
    private $session;
    private $apiUrl = 'https://api.embloy.com';
    private $baseUrl = 'https://embloy.com';
    private $apiVersion = 'api/v0';
    private $httpClient;

    public function __construct($clientToken, $session) {
        $this->clientToken = $clientToken;
        $this->session = $session;
        $this->httpClient = new Client();
    }

    public function setHttpClient(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function makeRequest() {
        $data = [
            'mode' => $this->session->mode,
            'job_slug' => $this->session->job_slug,
            'success_url' => $this->session->success_url,
            'cancel_url' => $this->session->cancel_url,
        ];

        $headers = [
            'client_token' => $this->clientToken,
            'User-Agent' => 'embloy/0.1.2-beta.20 (PHP)',
            'Content-Type' => 'application/json',
        ];

        try {
            $response = $this->httpClient->post("{$this->apiUrl}/{$this->apiVersion}/sdk/request/auth/token", [
                'json' => $data,
                'headers' => $headers,
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new \Exception('Unexpected status code: ' . $response->getStatusCode());
            }

            $responseData = json_decode($response->getBody(), true);
            $requestToken = $responseData['request_token'];

            return "{$this->baseUrl}/sdk/apply?request_token={$requestToken}";
        } catch (\Exception $e) {
            echo 'Error in makeRequest: ' . $e->getMessage();
            throw $e;
        }
    }
}