<?php

require '_header.php';
use App\Services\Salesforce\SalesforceApi;

$frameworkId = $_GET['framework_id'];

$salesforceApi = new SalesforceApi();
$framework = $salesforceApi->getFramework($frameworkId);

$lots = $salesforceApi->query("SELECT Id, Long_Name__c, Expiry_Date__c, Name from Master_Framework_Lot__c WHERE Master_Framework__c = '" . $framework->Id . "'");

?>

<h1 class="title">Framework title: <?php echo $framework->Long_Name__c ?></h1>
<h2 class="subtitle">Framework ID: <?php echo $framework->RM_Number__c ?></h2>

<h3><b>Terms:</b> <?php echo $framework->Framework_Terms__c ?></h3>
<h3><b>Pillar:</b> <?php echo $framework->Pillar__c ?></h3>

<h3><b>RAW (off framework object) Category:</b> <?php echo $framework->CCS_Category__c ?></h3>
<h3><b>RAW (off framework object) Sub category:</b> <?php echo $framework->CCS_Sub_Category_Text__c ?></h3>

<h3><b>Status:</b> <?php echo $framework->Status__c ?></h3>

<h3><b>Framework start date:</b> <?php echo $framework->Start_Date__c ?></h3>
<h3><b>Framework end date:</b> <?php echo $framework->Effective_End_Date__c ?></h3>

<h3><b>Tenders open date:</b> <?php echo $framework->OJEU_Date_Target__c ?></h3>
<h3><b>Tenders close date:</b> <?php echo $framework->Tender_Closing_Date__c ?></h3>

<h3><b>Expected live date:</b> <?php echo $framework->Framework_Live_Date_Target__c ?></h3>
<h3><b>Expected award date:</b> <?php echo $framework->Award_Date_Target__c ?></h3>


<?php

$categoryObject = $salesforceApi->getCategory($framework->CCS_Sub_Category__c);

?>

<hr>
<h2 class="subtitle is-4">Category<br><small style="font-size: 0.65em;">This category is looking up the category object and returning the name, rather than relying on what is returned in text on the Framework</small></h2>

<h3><b><?php echo $categoryObject->Name ?></b></h3>


<hr>
<h2 class="subtitle is-4">Lots</h2>

<ul>
<?php
foreach ($lots->records as $index => $lot)
{
    $name = !empty($lot->Long_Name__c) ? $lot->Long_Name__c : $lot->Name;

    echo  '<li><a href="lot.php?lot_id=' . $lot->Id . '" style="text-decoration: underline;"><span style="width: 190px; display: inline-block">' . $lot->Id . '</span>' . $name . '</a> - Expiry: ' . $lot->Expiry_Date__c . '</li>';
}
?>
</ul>



<?php

require '_footer.php';

?>