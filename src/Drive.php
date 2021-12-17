<?php
require_once 'Client.php';

class Drive extends Client
{
    public function __construct()
    {
        $this->service = new \Google_Service_Drive($this->getClient());
    }

    public function getFolderContent($folderId, $mimeType=null)
    {        
        $this->folderId = '1JiOmuylTFi6cRYcSXvHNnAm1SQzZpUhN';
        $this->optParams = array(
            'orderBy' => 'name',
            'q' => "'{$folderId}' in parents",
            
        );

        if(!is_null($mimeType)){
            $this->optParams['q'] .= " and mimeType = '{$mimeType}'";
        }
        

        try {
            $result = $this->service->files->listFiles($this->optParams);

            return $result->getFiles();

        } catch (\Throwable $th) {
            throw new Exception("Error Drive::getFolderContent() -> {$th->getMessage()}", 1);
        }
    }

    public function getFolderContentJson($folderId, $mimeType=null)
    {
        try {
            $response = $this->getFolderContent($folderId, $mimeType);

            return json_encode($response, JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            $this->throwException($th);
        }
    }

    public function identify($contentId)
    {
        try{
            $content = $this->service->files->get($contentId);

            return $content->name;
        } catch (\Throwable $th) {
            throw new Exception("Error Drive::identify() -> {$th->getMessage()}", 1);
        }
    }
}