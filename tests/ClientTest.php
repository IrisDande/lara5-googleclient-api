<?php

namespace IrisDande\Google\tests;

use Mockery;
use PHPUnit_Framework_TestCase;

class ClientTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testClientGetter()
    {
        $client = Mockery::mock('IrisDande\Google\Client', [[]])->makePartial();

        $this->assertInstanceOf('Google_Client', $client->getClient());
    }

    public function testServiceMake()
    {
        $client = Mockery::mock('IrisDande\Google\Client', [[]])->makePartial();

        $this->assertInstanceOf('Google_Service_Storage', $client->make('storage'));
    }

    public function testServiceMakeException()
    {
        $client = Mockery::mock('IrisDande\Google\Client', [[]])->makePartial();

        $this->setExpectedException('IrisDande\Google\Exceptions\UnknownServiceException');

        $client->make('storag');
    }

    public function testMagicMethodException()
    {
        $client = new \IrisDande\Google\Client([]);

        $this->setExpectedException('BadMethodCallException');

        $client->getAuthTest();
    }

    public function testDefaultAuth()
    {
        $client = new \IrisDande\Google\Client([]);

        $this->assertInstanceOf('Google_Auth_OAuth2', $client->getAuth());
    }

    public function testAssertCredentials()
    {
        $client = new \IrisDande\Google\Client([
            'service' => [
                'enable' => true,
                'account' => 'name',
                'scopes'  => ['scope'],
                'key'     => __DIR__.'/data/cert.p12',
            ],
        ]);

        $this->assertInstanceOf('Google_Auth_OAuth2', $client->getAuth());
    }

    public function testAppEngineCredentials()
    {
        $_SERVER['SERVER_SOFTWARE'] = 'Google App Engine';

        $client = new \IrisDande\Google\Client([
            'service' => [
                'enable' => true,
            ],
        ]);

        $this->assertInstanceOf('Google_Auth_AppIdentity', $client->getAuth());

        unset($_SERVER['SERVER_SOFTWARE']);
    }

    public function testComputeEngineCredentials()
    {
        $client = new \IrisDande\Google\Client([
            'service' => [
                'enable' => true,
            ],
        ]);

        $this->assertInstanceOf('Google_Auth_ComputeEngine', $client->getAuth());
    }
}
