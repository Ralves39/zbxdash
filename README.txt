Criado por Rodrigo Soares

Pegue o historico de itens do zabbix diretamente por uma pagina web. Sem refresh de pagina e sem usar o banco de daados para isso.
Somente o itemkey do item.

Configuração
1 - Baixe o conteudo do software diretamente para a pasta www do seu servidor apache eixando a seguinte estrutura.
    /var/www/zbxdash ou /var/www/html/zbxdash
    
2 - Após entre na pasta /var/www/zbxdash/conf e edite o arquivo conf.php inserindo os seguintes parametros nas variaveis.
$user_zbx='Admin';//Usuario com acesso a api do zabbix
$passwd='zabbix';//senha com acesso a api do zabbix
$ip_zbx='127.0.0.1';//IP de acesso a api do zabbix

Pronto seu zbxdash esta habilitado, o acesso a tela se da pela a URL http://ipdoseuzabbix/zbxdash/windash.php

Espero que gostem e qualquer problema ou sujestão de melhoria estamos ai!

lembrando que se fez o download, deixe aquele RT maroto, para que eu possa conseguir um emprego bacana :)

Rodrigo Soares
rodrigo_s.alves@hotmail.com


English Version

Created by Rodrigo Soares

The history of zabbix items directly by a web page. No update and no database use for this.
Only the item itemkey.

Configuration
1 - Download the software content directly to a www folder. From your apache server by issuing the following structure.
/ var / www / zbxdash or / var / www / html / zbxdash

2 - After the / var / www / zbxdash / conf folder, edit the conf.php file and the parameters in the variables.
$ user_zbx = 'Admin'; // User with access to a zabbix api
$ passwd = 'zabbix'; // password with access to a zabbix api
$ ip_zbx = '127.0.0.1' // Access IP to a zabbix api

Ready your zbxdash is enabled, access a screen by a URL http: //ipdoseuzabbix/zbxdash/windash.php

I hope you enjoy it and any problems or your stuffing are there!

remembering who downloaded it, who gave RT maroto, so I can get a nice job :)

Rodrigo Soares
rodrigo_s.alves@hotmail.com
