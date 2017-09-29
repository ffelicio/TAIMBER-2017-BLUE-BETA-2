<?php

// carrega as extensões disponíveis
include_once("extensoes.php");

// nomes de pastas
$nome_pasta[0] = "acoes";
$nome_pasta[1] = "kernel";
$nome_pasta[2] = "php";
$nome_pasta[3] = "css";
$nome_pasta[4] = "js";
$nome_pasta[5] = "controlador";
$nome_pasta[6] = "recursos";
$nome_pasta[7] = "fontes";
$nome_pasta[8] = "jquery";
$nome_pasta[9] = "mysql";
$nome_pasta[10] = "arquivos_usuarios";
$nome_pasta[11] = "imagem_perfil";
$nome_pasta[12] = "imagens_sistema";

// nome de funções que não podem ter o nome alterado
$nome_funcao[0] = "chama_funcao";
$nome_funcao[1] = "valor_parametro";
$nome_funcao[2] = "chama_classe";
$nome_funcao[3] = "conecta_mysql";

// paginas do site
define("PAGINA_INICIAL", HOST_SERVIDOR."/");
define("PAGINA_ACOES", HOST_SERVIDOR."/$nome_pasta[0]/");

// pastas root do sistema
define("PASTA_KERNEL", ROOT_SERVIDOR."/$nome_pasta[1]/");
define("PASTA_CONSTROLADORA", PASTA_KERNEL."$nome_pasta[5]");
define("PASTA_BIBLIOTECA_PHP", PASTA_KERNEL."$nome_pasta[2]");
define("PASTA_BIBLIOTECA_CSS", PASTA_KERNEL."$nome_pasta[3]");
define("PASTA_BIBLIOTECA_JS", PASTA_KERNEL."$nome_pasta[4]");
define("PASTA_RECURSOS_ROOT", ROOT_SERVIDOR."/$nome_pasta[6]");
define("PASTA_FONTES_ROOT", PASTA_RECURSOS_ROOT."/$nome_pasta[7]");
define("PASTA_MYSQL_ROOT", PASTA_KERNEL."/$nome_pasta[9]");
define("PASTA_ARQUIVOS_USUARIOS_ROOT", ROOT_SERVIDOR."/$nome_pasta[10]/");

// pastas host do sistema
define("PASTA_RECURSOS_HOST", PAGINA_INICIAL."$nome_pasta[6]");
define("PASTA_FONTES_HOST", PASTA_RECURSOS_HOST."/$nome_pasta[7]");
define("PASTA_ARQUIVOS_USUARIOS_HOST", PAGINA_INICIAL."$nome_pasta[10]/");
define("PASTA_IMAGENS_SISTEMA", PAGINA_INICIAL."$nome_pasta[6]/$nome_pasta[12]/");

// arquivos controladores
define("CONTROLADOR_FUNCOES", PASTA_CONSTROLADORA."/$nome_funcao[0]".$extensao_arquivo["php"]);
define("CONTROLADOR_PARAMETRO", PASTA_CONSTROLADORA."/$nome_funcao[1]".$extensao_arquivo["php"]);
define("CONTROLADOR_CLASSE", PASTA_CONSTROLADORA."/$nome_funcao[2]".$extensao_arquivo["php"]);

// conector do mysql
define("CONECTOR_MSYQL", PASTA_MYSQL_ROOT."/".$nome_funcao[3].$extensao_arquivo["php"]);

// jquerys
define("ARQUIVO_JQUERY", PASTA_RECURSOS_HOST."/$nome_pasta[8]/jquery".$extensao_arquivo["js"]);
define("ARQUIVO_JQUERY_FORM", PASTA_RECURSOS_HOST."/$nome_pasta[8]/jquery_form".$extensao_arquivo["js"]);

?>