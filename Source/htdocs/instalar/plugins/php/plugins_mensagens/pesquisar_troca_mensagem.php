<?php

// pesquisa troca de mensagens
function pesquisar_troca_mensagem($uidamigo){

// globals
global $tabela_banco;

// termo de pesquisa
$termo_pesquisa = retorne_campo_formulario_request(22);

// zerar o contador
if(retorne_campo_formulario_request(20) == 1){
	
	// limit
    $limit = retorne_limit_query(retorne_tipo_acao_pagina(), true);

	// zerou contador
	$zerou_contador = 1;	
	
}else{
	
    // limit
    $limit = retorne_limit_query(retorne_tipo_acao_pagina(), false);

	// zerou contador
	$zerou_contador = 0;	
	
};

// tabela
$tabela = $tabela_banco[15];

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// valida o termo de pesquisa
if($termo_pesquisa != null){
	
	// query
	$query = "select *from $tabela where mensagem like '%$termo_pesquisa%' and uid='$idusuario' order by id desc $limit;";
	
}else{
	
	// valida uidamigo passado como parametro
	if($uidamigo == null){

        // query
	    $query = "select *from $tabela where uid='$idusuario' order by id desc $limit;";

	}else{
		
        // query
	    $query = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo' order by id desc $limit;";
		
	};
	
};

// array de retorno
$array_retorno["dados"] = constroe_mensagem(plugin_executa_query($query), false, false);
$array_retorno["zerou_contador"] = $zerou_contador;

// retorno
return json_encode($array_retorno);

};

?>