<?php

namespace SCTV;

use Bugsnag\Client;
use Bugsnag\Handler;

class Bugsnag
{
    private static $instance;
    private $client;

    private function __construct()
    {
    }

    /**
     * getInstance
     *
     * @return \SCTV\Bugsnag
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Bugsnag();
        }

        return self::$instance;
    }

    /**
     * createClient
     *
     * @param string $apiKey ApiKey
     * @return Bugsnag\Client
     */
    public function createClient($apiKey)
    {
        if ($this->client === null) {
            $this->client = Client::make($apiKey);
            Handler::register($this->client);
        }

        return $this->client;
    }

    /**
     * getClient
     *
     * @return Bugsnag\Client
     */
    public function getClient()
    {
        return $this->client;
    }
}