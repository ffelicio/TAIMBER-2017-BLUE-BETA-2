<?php

// codificacao da pagina
header("Content-Type: text/html; charset=utf-8");

// dados do servidor
define("ROOT_SERVIDOR", $_SERVER['DOCUMENT_ROOT']);

// carrega configuracoes do servidor
include_once(ROOT_SERVIDOR."/servidor/configuracoes_servidor.php");

// habilita ou não o gzip
if(HABILITAR_GZIP == true){
	
	// ativa o buffer de saida e envia a funcao ob_gzhandler para compactar dados
	ob_start("ob_gzhandler");

};

// carrega as bibliotecas
include_once($arquivo_sistema_root["php"]);
include_once($arquivo_sistema_root["paginas_php"]);

// carrega o controlador php dos recursos do sistema
include_once(CONTROLADOR_FUNCOES);

// carrega o controlador de parametros das funções
include_once(CONTROLADOR_PARAMETRO);

// carrega o controlador de classes
include_once(CONTROLADOR_CLASSE);

// carrega o conector do mysql
include_once(CONECTOR_MSYQL);

// conecta ao mysql e seleciona a base de dados
conecta_mysql(true);

// conteúdo de json
echo chama_funcao(FUNC_CONTEUDO_JSON);

// habilita ou não o gzip
if(HABILITAR_GZIP == true){
	
	// finaliza o buffer de dados
	ob_end_flush();

};

?>