<?php
require_once 'Client.php';

class Docs extends Client
{
    public function __construct()
    {
        $this->service = new \Google_Service_Docs($this->getClient());
    }

    public function readDoc($documentId)
    {
        $response = [];

        try {
            $document = $this->service->documents->get($documentId);
            return $document->body->getContent();
        } catch (\Throwable $th) {
            throw new Exception("Error Docs::readDoc() -> {$th->getMessage()}", 1);
        }
        
        

        return $response;
    }

    public function getDocJson($documentId)
    {
        $response = [];

        try {
            foreach($this->readDoc($documentId) as $cKey=>$content){
                if($content->paragraph){
                    $response[$cKey] = $this->getParagraphContent($content->paragraph);
                }elseif($content->table){
                    $response[$cKey] = $this->getTableContent($content->table);
                }
            }
    
            return json_encode($response, JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            $this->throwException($th);
        }
        
    }

    private function getParagraphContent($content)
    {
        $response = [];

        foreach($content->getElements() as $key=>$paragraph){
            $response[$key] = $paragraph->textRun->getContent();
        }

        return $response;
    }


    private function getTableContent($content)
    {
        $response = [];

        foreach($content->tableRows as $key=>$row){
            $response[$key] = $this->getCellContent($row);
        }

        return $response;
    }

    private function getCellContent($content)
    {
        $response = [];

        foreach($content->tableCells as $key=>$cell){
            $response[$key] = $this->getContent($cell);
        }

        return $response;
    }

    private function getContent($content)
    {
        $response = [];

        foreach($content->getContent() as $key=>$paragraph){
            $response[$key] = $this->getParagraphContent($paragraph->paragraph);
        }

        return $response;
    }
}