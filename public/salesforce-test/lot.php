<?php

require '_header.php';
use App\Services\Salesforce\SalesforceApi;

$lotId = $_GET['lot_id'];

$salesforceApi = new SalesforceApi();
$lot = $salesforceApi->getLot($lotId);

$suppliersToDisplay = $salesforceApi->query("SELECT Id, Supplier__c from Supplier_Framework_Lot__c WHERE Master_Framework_Lot__c = '" . $lot->Id . "' AND (Status__c = 'Live' OR Status__c = 'Suspended')");

$suppliers = [];
foreach ($suppliersToDisplay->records as $supplierToDisplay)
{
    $suppliers[] = $salesforceApi->getAccount($supplierToDisplay->Supplier__c);
}

$name = !empty($lot->Long_Name__c) ? $lot->Long_Name__c : '<small style="color: red;"><i>Long_Name__c</i> is empty. Falling back on <i>Name</i> field</small><br>' . $lot->Name;

?>

<h1 class="title"><b>Name:</b> <?php echo $name ?></h1>

<h3><b>ID:</b> <?php echo $lot->Id ?></h3>
<h3><b>Framework ID:</b> <?php echo $lot->Master_Framework__c ?></h3>
<h3><b>Lot number:</b> <?php echo $lot->Master_Framework_Lot_Number__c ?></h3>
<h3><b>Lot title:</b> <?php echo $lot->Long_Name__c ?></h3>
<h3><b>Lot status:</b> <?php echo $lot->Status__c ?></h3>
<h3><b>Lot expiry date:</b> <?php echo $lot->Expiry_Date__c ?></h3>

<hr>
<h3 class="subtitle is-4">Suppliers</h3>

<ul>
<?php
foreach ($suppliers as $index => $supplier)
{
    echo  '<li><a href="supplier.php?account_id=' . $supplier->Id . '" style="text-decoration: underline;"><span style="width: 190px; display: inline-block">' . $supplier->Id . '</span>' . $supplier->Name . '</a></li>';
}
?>
</ul>

<?php

require '_footer.php';

?>