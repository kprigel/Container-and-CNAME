<?php



Function ContAndCNAME($ContName,$BaseDomainName){

require_once('php-opencloud.php');

// Your Rackspace Cloud credentials
define('AUTHURL', RACKSPACE_US);
define('USERNAME', 'Insert USERNAME Here');
define('APIKEY', 'Insert APIKEY Here');

// establish our credentials
$connection = new \OpenCloud\Rackspace(AUTHURL,
array( 'username' => USERNAME,
'apiKey' => APIKEY));

// connect to Cloud Files
$objstore = $connection->ObjectStore('cloudFiles', 'DFW');

// create container
$container = $objstore->Container();
$container->Create(array('name'=>$ContName));

// publish container to cdn, get url
$cdnversion = $container->PublishToCDN();
$CNAMEResolves =$container->PublicURL();

// connect to dns
$dns = $connection->DNS();

// create new cname
$NewCNAME = $ContName . "." . $BaseDomainName;

$dlist=$dns->DomainList(array('name'=>$BaseDomainName));
$domain=$dlist->Next();

$record = $domain->Record();
$record->Create(array(
'type' => 'CNAME',
    'name' => $NewCNAME,
    'ttl' => 600,
    'data' => $CNAMEResolves));
}

?>