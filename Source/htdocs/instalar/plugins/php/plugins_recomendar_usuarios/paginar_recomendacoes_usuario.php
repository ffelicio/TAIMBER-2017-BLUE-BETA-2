<?php

// pagina as recomendacoes de usuarios
function paginar_recomendacoes_usuario(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[37];

// modo
$modo = retorne_campo_formulario_request(6);

// tipo de acao
$tipo_acao = retorne_tipo_acao_pagina();

// id de usuario logado
$uid = retorne_idusuario_logado();

// valida o modo
if($modo == true){
	
	// limit de query
	$limit = "limit ".contador_avanco($tipo_acao, 8).", ".NUMERO_RECOMENDACOES_INICIO;

}else{
	
	// limit de query
	$limit = "limit ".contador_avanco($tipo_acao, 9).", ".NUMERO_RECOMENDACOES_INICIO;

};

// query
$query = "select *from $tabela where uid='$uid' order by id desc $limit;";

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// valida o numero de linhas
if($linhas == 0){
	
	// retrocede o contador de avanco de limit de query
	contador_avanco($tipo_acao, 9);
	
	// array de retorno
	$array_retorno["limpar_dados_antigos"] = 0;

	// retorno
	return json_encode($array_retorno);
	
};

// contador
$contador = 0;

// construindo paginas
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separando dados
	$uidamigo = $dados[UIDAMIGO];
	
	// valida uidamigo
	if($uidamigo != null){
		
		// campo de perfil de usuario
		$campo[0] = constroe_imagem_perfil_medio($uidamigo);
		
		// campos
		$campo[0] = "
		<div class='classe_separa_usuario_recomendado'>
		$campo[0]
		</div>
		";
		
		// constroe a pagina em miniatura de sugestao
		$html .= $campo[0];

	};
	
};

// array de retorno
$array_retorno["dados"] = $html;
$array_retorno["limpar_dados_antigos"] = 1;

// retorno
return json_encode($array_retorno);

};

?>