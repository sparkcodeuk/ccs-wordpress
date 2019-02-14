<?php

use App\Repository\FrameworkRepository;
use App\Repository\LotRepository;
use App\Services\Salesforce\SalesforceApi;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../../.env');

$importCount = [
      'frameworks' => 0,
      'lots'       => 0,
      'suppliers'  => 0
    ];

    $errorCount = [
      'frameworks' => 0,
      'lots'       => 0,
      'suppliers'  => 0
    ];

    $salesforceApi = new SalesforceApi();

    $frameworks = $salesforceApi->getAllFrameworks();
    $frameworkRepository = new FrameworkRepository();
    $lotRepository = new LotRepository();
    
    

    foreach ($frameworks as $framework)
    {
        if (!$frameworkRepository->createOrUpdate('salesforce_id', $framework->getSalesforceId(), $framework))
        {
            $errorCount['frameworks']++;
            continue;
        }
        
        $importCount['frameworks']++;
    }


    $lots = $salesforceApi->getAllLots();

    foreach ($lots as $lot)
    {
        $lotRepository->createOrUpdate('salesforce_id', $lot->getSalesforceId(), $lot);
        $importCount['lots']++;
    }

    return $importCount;

