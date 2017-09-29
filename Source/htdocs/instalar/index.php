<?php

// codificacao da pagina
header("Content-Type: text/html; charset=utf-8");

// variaveis de configuracoes
$permite_query = true;

// variaveis de instalação
define("SESSAO_INSTALA_DATA_HOJE", date("d-m-Y"));
define("SESSAO_INSTALA_BANCO_DADOS", md5("CONFIG_INSTALA_BD"));

// dados do servidor
define("ROOT_SERVIDOR_SCRIPT", $_SERVER['DOCUMENT_ROOT']);

// carrega configuracoes do servidor
include_once(ROOT_SERVIDOR_SCRIPT."/servidor/configuracoes_servidor.php");

// carrega plugins necessarios
include_once($pasta_root_sistema["plugins_php"]."plugins_arquivos/plugin_listar_arquivos.php");
include_once($pasta_root_sistema["plugins_php"]."plugins_arquivos/ler_conteudo_arquivo.php");

// instala os plugins e aparencia
include_once("instalar_plugins".$extensao_arquivo["php"]);
include_once("instalar_plugins_paginas".$extensao_arquivo["php"]);

// instala o banco de dados
include_once($pasta_root_sistema["pasta_instala_banco"]."instalar_banco_tabelas".$extensao_arquivo["php"]);

// valida se a instalação foi completa ou parcial
// ao atualizar a página duas vezes a instalação é completada
if($_SESSION[SESSAO_INSTALA_BANCO_DADOS] == null){
	
	// atualiza a sessao
	$_SESSION[SESSAO_INSTALA_BANCO_DADOS] = SESSAO_INSTALA_DATA_HOJE;

	// exibe a informação de instalação
	echo $idioma_sistema[460];
	
}else{

	// exibe a informação de instalação
	echo $idioma_sistema[461];
	
};

?>