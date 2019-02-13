<?php

use App\Repository\FrameworkRepository;
use App\Services\Salesforce\SalesforceApi;

add_action( 'admin_menu', 'ccs_salesforce_import_admin_menu' );

/**
 *
 */
function ccs_salesforce_import_admin_menu() {
	add_menu_page( 'Run import', 'Salesforce import', 'manage_options', '/salesforce-import', 'ccs_salesforce_import', 'dashicons-welcome-widgets-menus', 60  );
}

/**
 *
 */
function ccs_salesforce_import(){
    $imported = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $importCount = run_import();
        $imported = true;
    }
        // Load the view to upload a file
        require(__DIR__ . '/templates/admin.php');
        exit;
}

/**
 * Run Salesforce import
 *
 * @throws \GuzzleHttp\Exception\GuzzleException
 * @throws \ReflectionException
 */
function run_import() {

    $salesforceApi = new SalesforceApi();
    
    $frameworks = $salesforceApi->getAllFrameworks();

    $frameworkRepository = new FrameworkRepository();

    $importCount = 0;
    foreach ($frameworks as $framework)
    {
        $success = $frameworkRepository->createOrUpdate('salesforce_id', $framework->getSalesforceId(), $framework);
        if ($success)
        {
            $importCount++;
        }
    }

    return $importCount;
}
