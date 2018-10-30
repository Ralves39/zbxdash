<?php
require_once 'lib/ZabbixApi.class.php';
require_once 'conf/conf.php';
use ZabbixApi\ZabbixApi;

//metodos para conectar zabbix
try
{
    // connect to Zabbix API
    $api = new ZabbixApi('http://'.$ip_zbx.'/zabbix/api_jsonrpc.php', $user_zbx, $passwd);

    /* ... do your stuff here ... */
}
catch(Exception $e)
{
    // Exception in ZabbixApi catched
    echo $e->getMessage();
}

$hostname=$_POST['server'];
//$hostname='Zabbix server';
$itemkey='';

function get_hostid($hostname,$api){
	$hosts = $api->hostGet(array(
        'output' => 'extend',
        'filter' => array('name' => $hostname)));
		foreach($hosts as $host)

	return $host->hostid;
}



function get_hostitemkey($hostid,$itemkey,$api){
	$items = $api->itemGet(array(
        'output' => 'extend',
		'hostids'=> $hostid,
		'sortfield' => 'key_',
		'sortorder' => 'DESC',
		'search' => array('key_' => $itemkey)
		));
		$a='';
		foreach($items as $item){
			$a=$a.";".$item->key_;
		}
		echo $a;
}
get_hostitemkey(get_hostid($hostname,$api),$itemkey,$api);


?>