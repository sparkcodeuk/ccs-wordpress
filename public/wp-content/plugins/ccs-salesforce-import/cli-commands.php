<?php
/**
 * Salesforce importer
 *
 * @see https://make.wordpress.org/cli/handbook/commands-cookbook/
 *
 */

namespace CCS\SFI;

use \WP_CLI;

use App\Model\LotSupplier;
use App\Repository\FrameworkRepository;
use App\Repository\LotRepository;
use App\Repository\LotSupplierRepository;
use App\Repository\SupplierRepository;
use App\Services\Salesforce\SalesforceApi;

WP_CLI::add_command('salesforce import', 'CCS\SFI\Import');

class Import
{

    /**
     * Imports Salesforce objects into Wordpress database
     *
     * ## EXAMPLES
     *
     *     wp salesforce import frameworks
     *
     * @when after_wp_load
     */

    public function all()
    {
        WP_CLI::success('Starting Import');

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

        foreach ($frameworks as $framework) {
            if (!$frameworkRepository->createOrUpdate('salesforce_id',
              $framework->getSalesforceId(), $framework)) {
                WP_CLI::error('Framework not imported...');
                $errorCount['frameworks']++;
                continue;
            }

            WP_CLI::success('Framework Imported...');
            $importCount['frameworks']++;

            $lots = $salesforceApi->getFrameworkLots($framework->getSalesforceId());

            foreach ($lots as $lot) {
                if (!$lotRepository->createOrUpdate('salesforce_id',
                  $lot->getSalesforceId(), $lot)) {
                    $errorCount['lots']++;
                    continue;
                }

                $importCount['lots']++;

                $suppliers = $salesforceApi->getLotSuppliers($lot->getSalesforceId());

                $supplierRepository = new SupplierRepository();
                $lotSupplierRepository = new LotSupplierRepository();

                // Remove all the current relationships to this lot, and create fresh ones.
                $lotSupplierRepository->deleteById($lot->getSalesforceId(),
                  'lot_id');

                foreach ($suppliers as $supplier) {
                    if (!$supplierRepository->createOrUpdate('salesforce_id',
                      $supplier->getSalesforceId(), $supplier)) {
                        $errorCount['suppliers']++;
                        continue;
                    }

                    $importCount['suppliers']++;
                    $lotSuppler = new LotSupplier([
                      'lot_id' => $lot->getSalesforceId(),
                      'supplier_id' => $supplier->getSalesforceId()
                    ]);
                    $lotSupplierRepository->create($lotSuppler);
                }

            }
        }

        return $response = [
          'importCount' => $importCount,
          'errorCount'  => $errorCount
        ];
    }


}