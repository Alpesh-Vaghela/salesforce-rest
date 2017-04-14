<?php
//For consumer key and consumer secret
//https://feedback.uservoice.com/knowledgebase/articles/235661-get-your-key-and-secret-from-salesforce 
//http://www.salesforce.com/us/developer/docs/api_rest/

ini_set("display_errors",true);
error_reporting(1);

require_once 'SalesforceAPI.php';

define("USERNAME", "alpesh.drcsystems@gmail.com");
define("PASSWORD", "A1mano@mano");
define("SECURITY_TOKEN", "j0TVCf87nB7QYUkB62c6yzeQ");

define("CONSUMER_KEY", "3MVG9d8..z.hDcPL_Rg1zwf7jwjUjNrzU3V3l.pmYVLYFHsxSmJtZp_GFeB3DYG_iiM4XMnxcVMglM_xMvOgJ");
define("CONSUMER_SECRET", "826682009741197425");

$salesforce = new SalesforceAPI('https://ap5.salesforce.com','32.0',CONSUMER_KEY, CONSUMER_SECRET);
$login = $salesforce->login(USERNAME,PASSWORD,SECURITY_TOKEN);

$api_versions = $salesforce->getAPIVersions();
$limits = $salesforce->getOrgLimits();
echo "<pre>"; print_r($limits);exit;
$resource = $salesforce->getAvailableResources();
$objects = $salesforce->getAllObjects();

$date = new DateTime();

$good_metadata = $salesforce->getObjectMetadata('Account');
$good_metadata_all = $salesforce->getObjectMetadata('Account', true);
$good_metadata_since = $salesforce->getObjectMetadata('Account', true, $date);
$bad_metadata = $salesforce->getObjectMetadata('SomeOtherObject');

$create_account = $salesforce->create( 'Account', ['name' => 'New Account'] );
$update_project = $salesforce->update( 'Account', $create_account->id, ['name' => 'Changed'] );
$project = $salesforce->get( 'Account', $create_account->id );
$project_with_fields = $salesforce->get( 'Account', $create_account->id, ['Name', 'OwnerId'] );
$delete_project = $salesforce->delete( 'Account', $create_account->id );

$response = $salesforce->searchSOQL('SELECT name from Position__c',true);
