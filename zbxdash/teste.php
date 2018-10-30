<?php
//itens de configuração/////////////////////////
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


function get_hostid($hostname,$api){
	$hosts = $api->hostGet(array(
        'output' => 'extend',
        'filter' => array('name' => $hostname)));
		foreach($hosts as $host)

	return $host->hostid;
}

echo get_hostid('Zabbix server',$api);

?>