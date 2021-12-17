<?php
require './vendor/autoload.php';

class Client
{

    private $http;
    private $client;
    protected $service;

    private function getCredentials()
    {
        $filename = "./credentials/credential.json";
        if(file_exists($filename)){
            return $filename;
        }else{
            throw new Exception("Error Client::getCredentials() -> O Arquivo {$filename} não foi localizado!");
        }

    }

    protected function getClient()
    {
        try {
            $this->http = new \GuzzleHttp\Client(['verify'=>false]);
            $this->client = new \Google_Client();
            $this->client->setHttpClient($this->http);
            $this->client->setAuthConfig($this->getCredentials());
            $this->client->addScope(\Google_Service_Drive::DRIVE);
            $this->client->setAccessType('offline');

            return $this->client;
        } catch (\Throwable $th) {
            throw new Exception("Error Client::getClient() -> {$th->getMessage()}", 1);
            
        }
        
    }

    protected function throwException($exceptionObject)
    {
        throw new Exception(
            json_encode(
                [
                    'ERROR' => $exceptionObject->getMessage()
                ]
                , JSON_PRETTY_PRINT), 1
        );
        
    }
}