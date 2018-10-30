<?php

//itens de configuração/////////////////////////

//funções daqui para baixo///////////////////////////////////////////////////////



function get_hostname($api){
	$hosts = $api->hostGet(array(
        'output' => 'extend',
		'sortfield' => 'name',
		'sortorder' => 'DESC'
		));
		foreach($hosts as $host){
			echo "<option value=\"".$host->host."\">".$host->host."</option>";
		}
}


function get_hostid($hostname,$api){
	$hosts = $api->hostGet(array(
        'output' => 'extend',
        'filter' => array('name' => $hostname)));
		foreach($hosts as $host)

	return $host->hostid;
}

?>