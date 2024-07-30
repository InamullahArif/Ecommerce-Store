<?php
require 'vendor/autoload.php';

use Algolia\AlgoliaSearch\SearchClient;
use Algolia\AlgoliaSearch\Exceptions\UnreachableException;

$applicationID = '6H26XH7WYO';
$adminAPIKey = 'f970e502b0d2d71f748b847bba5b53aa';

try {
    // Initialize the Algolia client
    $client = SearchClient::create($applicationID, $adminAPIKey);

    // Debugging statements
    echo "Algolia Application ID: $applicationID\n";
    echo "Algolia Admin API Key: $adminAPIKey\n";

    // Initialize an index
    $index = $client->initIndex('your_index_name');

    // Add records to the index
    $records = [
        ['objectID' => 1, 'name' => 'Record 1'],
        ['objectID' => 2, 'name' => 'Record 2'],
    ];
    $index->saveObjects($records);

    // Perform a search
    $results = $index->search('Record 1');
    var_dump($results['hits']);
} catch (UnreachableException $e) {
    echo "Error: Impossible to connect to Algolia. Please check your Application ID and API Key.\n";
    echo "Detailed error: " . $e->getMessage() . "\n";
}
