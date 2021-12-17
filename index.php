<?php

require_once './src/Drive.php';
require_once './src/Docs.php';
require_once './src/SpreadSheet.php';

$files = new Drive();
$docs = new Docs();
$sheets = new SpreadSheet();

$ranges = [
    '1a fase!A1:Z99',
    '2a fase!A1:Z99',
    '3a fase!A1:Z99',
    '4a fase!A1:Z99',
    '5a fase!A1:Z99',
    '6a fase!A1:Z99',
    '7a fase!A1:Z99',
    '8a fase!A1:Z99',
    '9a fase!A1:Z99'
];

var_dump(
    json_decode(
        $docs->getDocJson('17P_Fj0cl6IwSIaZuwzZnA2_2EJ8SEzpi1qi3lmPL1Qg')
    )
);