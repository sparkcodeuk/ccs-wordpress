<?php

require '_header.php';
use App\Services\Salesforce\SalesforceApi;
use App\Utils\EnvUpdater;

$salesforceApi = new SalesforceApi();

$response = $salesforceApi->generateToken();

?>



<h1 class="title">API credentials</h1>
<h2 class="subtitle">Please update your <b>.env</b> file with the access_token, and instance URL provided in this response.</h2>

<h3><b>Access token:</b> <?php echo $response->access_token ?></h3>
<h3><b>Instance URL:</b> <?php echo $response->instance_url ?></h3>


<?php

echo 'Now attempting to update <b>.env</b> file automatically';

$envUpdater = new EnvUpdater();
$envUpdater->changeValue(['SALESFORCE_ACCESS_TOKEN' => $response->access_token, 'SALESFORCE_INSTANCE_URL' => $response->instance_url . '/']);

require '_footer.php';

?>
