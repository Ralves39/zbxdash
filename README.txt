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
