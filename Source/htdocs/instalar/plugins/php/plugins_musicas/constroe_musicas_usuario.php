<?php

// constroe as musicas do usuario
function constroe_musicas_usuario($uid, $modo, $modo_link){

// modo true e o modo perfil e nao usa paginacao
// modo false e o modo normal usa paginacao

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[26];

// valida o modo
if($modo == true){
	
	// limit de query
	$limit_query = "limit ".NUMERO_MUSICAS_PERFIL_BASICO;
	
	// query
	$query = "select *from $tabela where uid='$uid' order by id desc $limit_query;";

}else{

	// contador de avanco
	$contador_avanco = contador_avanco(retorne_campo_formulario_request(2), 1) - NUMERO_VALOR_PAGINACAO;

	// limit de query
	$limit_query = "limit $contador_avanco, ".NUMERO_VALOR_PAGINACAO;

	// query
	$query = "select *from $tabela where uid='$uid' order by id desc $limit_query;";
	
};

// retorno
return constroe_player_playlist(false, plugin_executa_query($query));

};

?>