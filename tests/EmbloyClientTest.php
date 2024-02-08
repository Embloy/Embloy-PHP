<?php

use Embloy\EmbloyClient;
use Embloy\EmbloySession;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class EmbloyClientTest extends TestCase {
    public function testMakeRequest() {
        // Mock the Guzzle client
        $mockClient = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Define the expected data and headers
        $expectedData = [
            'mode' => 'test_mode',
            'job_slug' => 'test_job_slug',
            'success_url' => 'test_success_url',
            'cancel_url' => 'test_cancel_url',
        ];
        $expectedHeaders = [
            'client_token' => 'test_client_token',
            'User-Agent' => 'embloy/0.1.2-beta.20 (PHP)',
            'Content-Type' => 'application/json',
        ];

        // Create a mock response
        $responseBody = json_encode(['request_token' => 'test_request_token']);
        $mockResponse = new Response(200, [], $responseBody);

        // Configure the mock client to return the mock response
        $mockClient->expects($this->once())
            ->method('post')
            ->with(
                $this->equalTo('https://api.embloy.com/api/v0/sdk/request/auth/token'),
                $this->equalTo(['json' => $expectedData, 'headers' => $expectedHeaders])
            )
            ->willReturn($mockResponse);

        // Create an instance of EmbloySession
        $session = new EmbloySession('test_mode', 'test_job_slug', [
            'success_url' => 'test_success_url',
            'cancel_url' => 'test_cancel_url',
        ]);

        // Create an instance of EmbloyClient with the mock client
        $client = new EmbloyClient('test_client_token', $session);
        $client->setHttpClient($mockClient);

        // Call the makeRequest method and assert the response
        $result = $client->makeRequest();
        $this->assertEquals('https://embloy.com/sdk/apply?request_token=test_request_token', $result);
    }
}