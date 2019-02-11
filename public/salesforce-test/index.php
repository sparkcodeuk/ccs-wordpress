<?php

require '_header.php';
use App\Services\Salesforce\SalesforceApi;

$salesforceApi = new SalesforceApi();
$frameworks = $salesforceApi->query('SELECT Id, Long_Name__c, Don_t_publish_on_website__c, RM_Number__c from Master_Framework__c ORDER BY Long_Name__c ASC NULLS FIRST');


echo '<h1 class="title">Frameworks</h1>';
echo '<h2 class="subtitle">' . count($frameworks->records) . ' records found</h2>';

echo '<ul>';

foreach ($frameworks->records as $index => $framework)
{
    if ($framework->Don_t_publish_on_website__c)
    {
        echo  '<li><span style="width: 150px; display: inline-block">' . $framework->RM_Number__c . '</span> <a href="framework.php?framework_id=' . $framework->Id . '" style="background: red; color: black;">' . $framework->Long_Name__c . '</a></li>';
    } else {
        echo  '<li><span style="width: 150px; display: inline-block">' . $framework->RM_Number__c . '</span> <a href="framework.php?framework_id=' . $framework->Id . '" style="text-decoration: underline;">' . $framework->Long_Name__c . '</a></li>';
    }

}

echo '</ul>';


require '_footer.php';