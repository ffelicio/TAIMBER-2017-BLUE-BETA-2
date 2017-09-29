<?php

// carrega os aniversariantes
function carregar_aniversariantes(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[25];

// id de usuario logado
$uid = retorne_idusuario_logado();

// limit
if(retorne_campo_formulario_request(20) == 1){
	
	// limit de query
	$limit = retorne_limit_query(retorne_tipo_acao_pagina(), true);

}else{
	
	// limit de query
	$limit = retorne_limit_query(retorne_tipo_acao_pagina(), false);	
	
};

// query
$query = "select *from $tabela where uid='$uid' order by id desc $limit;";

// contador
$contador = 0;

// dados de query
$dados_query = plugin_executa_query($query);

// numero de linhas
$numero_linhas = $dados_query["linhas"];

// constroe usuarios
for($contador == $contador; $contador <= $numero_linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa dados
	$uidamigo = $dados[UIDAMIGO];
	
	// valida uidamigo
	if($uidamigo != null){

		// campo com perfil de usuario
		$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, false, $uidamigo);
		
		// html
		$html .= "
		<div class='classe_div_separa_amigo_visualizar_perfil'>$imagem_perfil_usuario</div>	
		";
	
	};
	
};

// array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>