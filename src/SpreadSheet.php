<?php
require_once 'Client.php';

class SpreadSheet extends Client
{
    public function __construct()
    {
        $this->service = new \Google_Service_Sheets($this->getClient());
    }

    public function readSheet($spreadSheetId, $ranges, $likeColumns=true)
    {
        
        try {
            $result = $this->service->spreadsheets_values->batchGet($spreadSheetId, [
                'ranges'=>$ranges, 
                'majorDimension'=>($likeColumns ? 'COLUMNS' : 'ROWS');
            ]);
    
            return $result->valueRanges;
        } catch (\Throwable $th) {
            throw new Exception("Error SpreadSheet::readSheet() -> {$th->getMessage()}", 1);
        }
        
    }

    public function getSpreadSheetJson($spreadSheetId, $ranges, $likeColumns=true)
    {
        try {
            $response = $this->readSheet($spreadSheetId, $ranges, $majorDimention);
            
            return json_encode($response, JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            $this->throwException($th);
        }
    }
}