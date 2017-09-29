<?php

// abre media player
function abrir_media_player($modo){

// modo true abre musica
// modo false abre video

// globals
global $tabela_banco;

// id de media
$id = retorne_campo_formulario_request(4);

// valida id
if($id == null){
	
	// retorno nulo
	return null;
	
};

// valida o modo
if($modo == true){
	
	// tabela
	$tabela = $tabela_banco[26];
	
}else{
	
	// tabela
	$tabela = $tabela_banco[27];	
	
};

// valida id existe
if(retorne_id_existe($id, $tabela) == false){
	
	// retorno
	return mensagem_conteudo_indisponivel();
	
};

// query
$query = "select *from $tabela where id='$id';";

// campos
$campo[0] = constroe_player(false, plugin_executa_query($query));

// retorno
return constroe_conteudo_padrao(true, $campo[0], null);

};

?>