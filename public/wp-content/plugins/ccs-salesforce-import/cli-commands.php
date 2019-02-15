<?php
/**
 * Salesforce importer
 *
 * @see https://make.wordpress.org/cli/handbook/commands-cookbook/
 *
 */
namespace CCS\SFI;
use \WP_CLI;

WP_CLI::add_command('salesforce import', 'CCS\SFI\Import');

class Import {

    /**
     * Imports Salesforce objects into Wordpress database
     *
     * ## EXAMPLES
     *
     *     wp salesforce import frameworks
     *
     * @when after_wp_load
     */

    public function frameworks() {

        WP_CLI::success('frameworks');
    }

    public function lots() {
        WP_CLI::success('lots');
    }

}
