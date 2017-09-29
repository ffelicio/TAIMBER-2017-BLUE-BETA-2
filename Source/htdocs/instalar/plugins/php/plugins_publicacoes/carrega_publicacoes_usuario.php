<?php

// carrega as publicacoes do usuario
function carrega_publicacoes_usuario(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[5];

// id de usuario
$uid = retorne_idusuario_request();

// limit de query
$limit_query = retorne_limit_query_iniciar(false, null);

// id de pagina via requeste
$pagina = retorne_idpagina_request();

// valida se o usuário está logado, e se está no modo pagina
if(retorne_usuario_logado() == false and retorne_modo_pagina() == false){
	
	// retorno nulo
	return null;
	
};

// valida pagina
if($pagina == null){

	// perfil normal do usuario
	$query = "select *from $tabela where uid='$uid' and pagina='' order by id desc $limit_query;";

}else{

	// conteudo de pagina
	$query = "select *from $tabela where pagina='$pagina' order by id desc $limit_query;";

};

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// contador
$contador = 0;

// carregando dados
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// array de dados mantém compatibilidade...
	$array_dados[0] = $dados;
	
	// construindo publicação
	$html .= constroe_publicacao($array_dados);
	
};

// array com retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>