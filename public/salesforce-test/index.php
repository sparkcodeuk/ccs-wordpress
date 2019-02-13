<?php

require '_header.php';

use App\Repository\FrameworkRepository;
use App\Services\Salesforce\SalesforceApi;

//$salesforceApi = new SalesforceApi();
//$frameworks = $salesforceApi->query('SELECT Id, Long_Name__c, Don_t_publish_on_website__c, RM_Number__c from Master_Framework__c ORDER BY Long_Name__c ASC NULLS FIRST');

$salesforceApi = new SalesforceApi();
$frameworks = $salesforceApi->getAllFrameworks();

$frameworkRepository = new FrameworkRepository();

foreach ($frameworks as $framework)
{
    $frameworkRepository->createOrUpdate('salesforce_id', $framework->getSalesforceId(), $framework);
}


echo '<h1 class="title">Frameworks</h1>';
echo '<h2 class="subtitle">' . count($frameworks) . ' records found</h2>';

echo '<ul>';

foreach ($frameworks as $framework)
{
    echo  '<li><span style="width: 150px; display: inline-block">' . $framework->getRmNumber() . '</span> <a href="framework.php?framework_id=' . $framework->getSalesforceId() . '" style="text-decoration: underline;">' . $framework->getTitle() . '</a></li>';
}

echo '</ul>';


require '_footer.php';