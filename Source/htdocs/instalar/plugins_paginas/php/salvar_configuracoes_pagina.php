<?php

// salva as configuracoes da pagina
function salvar_configuracoes_pagina(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[23];

// dados de formulario
$valor_campo = retorne_campo_formulario_request(27);
$numero_configuracao = retorne_campo_formulario_request(28);
$pagina = retorne_idpagina_request();

// valida usuario dono da pagina
if(retorne_usuario_dono_pagina(retorne_idusuario_logado(), $pagina) == false or retorne_pagina_existe($pagina) == false){
	
	// retorno nulo
	return null;

};

// array com campos de tabelas
$array_campos_tabela = explode(",", CAMPO_TABELA_CONFIGURACOES_PAGINA_CORPO);

// campo de tabela
$campo_tabela = trata_campo_tabela($array_campos_tabela[$numero_configuracao], false);

// querys
$query[0] = "select *from $tabela where pagina='$pagina';";
$query[1] = "insert into $tabela values(null, '$pagina', '1', '1', '1', '1');";
$query[2] = "update $tabela set $campo_tabela='$valor_campo' where pagina='$pagina';";

// dados de query
$dados_query = plugin_executa_query($query[0]);

// valida o numero de linhas
if($dados_query["linhas"] == 0){

    // adiciona e atualiza...
	plugin_executa_query($query[1]);
	plugin_executa_query($query[2]);

}else{
	
	// atualiza
	plugin_executa_query($query[2]);
	
};

};

?>