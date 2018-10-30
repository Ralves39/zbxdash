<?php

require_once 'lib/ZabbixApi.class.php';
require_once 'lib/metodos.php';
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




?>

<!doctype html>
<html lang="pt/br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!--Datapicker-->
   <script src="./js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />   
	
	
<link rel="stylesheet" href="css/autocomplete.css" type="text/css">
<script src="js/autocomplete.js"></script>
	
    <title>ZBXDASH - Windows </title>
	
	
  </head>
  <body>
    
	<!--navbar zbxdash-->
<nav class="navbar navbar-light bg-light">
    <img src="./img/zbxlogo.png" width="150" height="50" alt="">
</nav>

<!--menu de pesquisa-->
<div class="card">

<div class="card-header">
  <a class="btn btn-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Pesquisar Servidor
  </a>
</div>
 
<div class="collapse" id="collapseExample">
	<form>
		<div class="col-md-2 float-left m-1">
		<select id="servidor" onChange="achakeys(this.value)" class="form-control" width="300" >
		<?php get_hostname($api);?>
		</select>
		</div>

		<div class="col-md-3 float-left m-1">
		<select id="item" class="form-control" width="300">
		</select>
		</div>
		
		<div class="col-md-3 float-left m-1">
		<select id="itemtype" class="form-control" width="300" placeholder="Typo do Item">
		<option value="0">numeric float</option>
		<option value="1">character</option>
		<option value="2">log</option>
		<option value="3">numeric unsigned</option>
		<option value="4">text</option>
		</select>
		</div>

		<div class="col-md-3 float-left m-1">
		<input id="datepicker" width="300" placeholder="De:"/>
		</div>
			
		<div class="col-md-3 float-left m-1">
		<input id="datepicker2" width="300" placeholder="Ate:" />
		</div>
		<a onclick="buscar()" class="btn btn-primary">Buscar</a>
	</form>
</div>
</div><!--card-->	

<div id="dados" class="container">

<table class="table" id="dadostable">
    <thead>
        <tr>
            <th>Itemid</th><th>Clock</th><th>Value</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>data0</td><td>data1</td><td>data2</td>
        </tr>
    </tbody>
</table>
<input class="btn btn-primary" type="button" id="btnExport" value=" Export to Excel " />
</div>
	
	<!--Scripts de autocomplete-->
<script>
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4'
        });
</script>	
	
	
<script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
</script>	
	

<script>
function buscar(){
	buscadados();
	removetable();
	
};

function removetable(){
	$('#dadostable tbody tr').empty();
};


function buscadados(){
	
	var bla = $('#item').val();
	var ble = $('#servidor').val();
	var bli = $('#datepicker').val();
	var blo = $('#datepicker2').val();
	var blu = $('#itemtype').val();
	if (bla=="" || ble=="" || bli=="" || blo=="" || blu==""){
		alert("existe campos nulos preencha todos os campos");
	}else{
		
	$.post("buscahistorico.php",{server: ble, key: bla, dtinicio: bli, dtfim: blo, type: blu},function(result){
		  var a = result;
			alert(a);
			$(a).appendTo($("#dadostable tbody"));
        });
		
		
	}
	
};


function removeOptions(obj) {
$(obj)
    .find('option')
    .remove()
    .end()
;

};

function achakeys(valor){
	removeOptions("#item");
	$.post("itemkey.php",{server: valor},function(result){
		  var a = result;
		  var array = a.split(';');
			array.forEach(function(item){
					$('#item').append('<option>' + item + '</option>');
				});
        });
};
</script>
<script src="./js/jquery.btechco.excelexport.js"></script>
<script src="./js/jquery.base64.js"></script>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#dadostable").btechco_excelexport({
                containerid: "dadostable"
               , datatype: $datatype.Table
               , filename: 'export'
            });
        });
    });
</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
