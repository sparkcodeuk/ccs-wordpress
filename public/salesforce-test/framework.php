<?php

require '_header.php';

use App\Model\Framework;
use App\Repository\FrameworkRepository;
use App\Services\Salesforce\SalesforceApi;



//print_r($frameworkRepository->findAll());
//die();



$frameworkId = $_GET['framework_id'];

$frameworkRepository = new FrameworkRepository();
$framework = $frameworkRepository->findById($frameworkId, 'salesforce_id');

$salesforceApi = new SalesforceApi();

$lots = $salesforceApi->query("SELECT Id, Long_Name__c, Expiry_Date__c, Name from Master_Framework_Lot__c WHERE Master_Framework__c = '" . $framework->getSalesforceId() . "'");

?>

<h1 class="title">Framework title: <?php echo $framework->getTitle(); ?></h1>
<h2 class="subtitle">Framework ID: <?php echo $framework->getRmNumber(); ?></h2>

<h3><b>Terms:</b> <?php echo $framework->getTerms() ?></h3>
<h3><b>Pillar:</b> <?php echo $framework->getPillar() ?></h3>

<h3><b>Category:</b> <?php echo $framework->getCategory() ?></h3>

<h3><b>Status:</b> <?php echo $framework->getStatus() ?></h3>

<h3><b>Framework start date:</b> <?php echo !empty($framework->getStartDate()) ? $framework->getStartDate()->format('d/m/Y') : ''?></h3>
<h3><b>Framework end date:</b> <?php echo !empty($framework->getEndDate()) ? $framework->getEndDate()->format('d/m/Y') : '' ?></h3>

<h3><b>Tenders open date:</b> <?php echo !empty($framework->getTendersOpenDate()) ? $framework->getTendersOpenDate()->format('d/m/Y') : '' ?></h3>
<h3><b>Tenders close date:</b> <?php echo !empty($framework->getTendersCloseDate()) ? $framework->getTendersCloseDate()->format('d/m/Y') : '' ?></h3>

<h3><b>Expected live date:</b> <?php echo !empty($framework->getExpectedLiveDate()) ? $framework->getExpectedLiveDate()->format('d/m/Y') : '' ?></h3>
<h3><b>Expected award date:</b> <?php echo !empty($framework->getExpectedAwardDate()) ? $framework->getExpectedAwardDate()->format('d/m/Y') : '' ?></h3>


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