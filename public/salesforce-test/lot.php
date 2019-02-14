<?php

require '_header.php';

use App\Model\LotSupplier;
use App\Repository\LotRepository;
use App\Repository\LotSupplierRepository;
use App\Repository\SupplierRepository;
use App\Services\Salesforce\SalesforceApi;

$lotId = $_GET['lot_id'];

$lotRepository = new LotRepository();
$lot = $lotRepository->findById($lotId, 'salesforce_id');

?>

<h1 class="title"><b>Name:</b> <?php echo $lot->getTitle() ?></h1>

<h3><b>ID:</b> <?php echo $lot->getId() ?></h3>
<h3><b>Framework ID:</b> <?php echo $lot->getFrameworkId() ?></h3>
<h3><b>Wordpress ID:</b> <?php echo $lot->getWordpressId() ?></h3>
<h3><b>Salesforce ID:</b> <?php echo $lot->getSalesforceId() ?></h3>
<h3><b>Lot number:</b> <?php echo $lot->getLotNumber() ?></h3>
<h3><b>Lot status:</b> <?php echo $lot->getStatus() ?></h3>
<h3><b>Expiry date:</b> <?php echo !empty($lot->getExpiryDate()) ? $lot->getExpiryDate()->format('d/m/Y') : '' ?></h3>
<h3><b>Should we hide suppliers?:</b> <?php echo $lot->isHideSuppliers() ?></h3>



<?php

$salesforceApi = new SalesforceApi();

$suppliers = $salesforceApi->getLotSuppliers($lotId);

$supplierRepository = new SupplierRepository();
$lotSupplierRepository = new LotSupplierRepository();

// Remove all the current relationships to this lot, and create fresh ones.
$lotSupplierRepository->deleteById($lot->getSalesforceId(), 'lot_id');

foreach ($suppliers as $supplier)
{
    $lotSuppler = new LotSupplier(['lot_id' => $lotId, 'supplier_id' => $supplier->getSalesforceId()]);
    $lotSupplierRepository->create($lotSuppler);
    $supplierRepository->createOrUpdate('salesforce_id', $supplier->getSalesforceId(), $supplier);
}

?>


<hr>
<h3 class="subtitle is-4">Suppliers</h3>

<ul>
<?php
foreach ($suppliers as $supplier)
{
    echo  '<li><a href="supplier.php?account_id=' . $supplier->getSalesforceId() . '" style="text-decoration: underline;"><span style="width: 190px; display: inline-block">' . $supplier->getSalesforceId() . '</span>' . $supplier->getName() . '</a></li>';
}
?>
</ul>

<?php

require '_footer.php';

?>