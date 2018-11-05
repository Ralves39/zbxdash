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
$itemkey=$_POST['key'];
$itemtype=$_POST['type'];
$dtinicio=$_POST['dtinicio'];
$dtfim=$_POST['dtfim'];


//$hostname='Zabbix server';
//$itemkey='agent.ping';
//$itemtype='3';
//$dtinicio='10/30/2018';
//$dtfim='10/30/2018';

$dtinicio=$dtinicio." 00:00:00";
$dtfim=$dtfim." 23:59:59";


function get_hostid($hostname,$api){
        $hosts = $api->hostGet(array(
        'output' => 'extend',
        'filter' => array('host' => $hostname)));

        foreach($hosts as $host){
        $teste=$host->host;
        if($teste==$hostname){
        $retorno= $host->hostid;
        };
        }
        return $retorno;
}


function get_itemid($hostname,$hostid,$itemkey,$api){
	$itens = $api->itemGet(array(
        'output' => 'extend',
		'hostids' => $hostid,
        	'search' => array('key_' => $itemkey ),
		'filter' => array('host' => $hostname),
		'sortfield' => 'name'
		));
		foreach($itens as $item){
		$teste = $item->key_; 
		if($teste==$itemkey){
		$valor=$item->itemid;
		};

		}
		return $valor;
}

function get_item_history($itemid,$itemtype,$dtinicio,$dtfim,$api){
	$historys = $api->historyGet(array(
        'output' => 'extend',
		'history' => $itemtype,
		'itemids' => $itemid,
		'sortfield' => 'clock',
		'sortorder' => 'DESC',
		'time_from' => $dtinicio,
		'time_till' => $dtfim
		));
		$valor=array();
		$clock=array();
		foreach($historys as $history){

	$valor[]=$history->value;
	$clock[]=$history->clock;
		}
		
	$string='';
	$int = count($valor);
	for($i=0;$i<$int;$i++){
		$string=$string."<tr><td>".$itemid."</td><td>".date('d/m/Y H:i:s', $clock[$i])."</td><td>".$valor[$i]."</td></tr>";
	}
	
		return $string;
}



$a = get_itemid($hostname,get_hostid($hostname,$api),$itemkey,$api);



$dtinicio_unix = new DateTime($dtinicio);
$dtfim_unix = new DateTime($dtfim);

$b = get_item_history($a,$itemtype,$dtinicio_unix->getTimestamp(),$dtfim_unix->getTimestamp(),$api);


echo $b;


?>
