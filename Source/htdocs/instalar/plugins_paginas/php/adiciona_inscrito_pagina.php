<?php

// adiciona inscrito na pagina
function adiciona_inscrito_pagina(){

// globals
global $tabela_banco;
global $idioma_sistema;

// tabela
$tabela = $tabela_banco[22];

// id de usuario logado
$uid = retorne_idusuario_logado();

// id de pagina
$pagina = retorne_idpagina_request();

// titulo da pagina
$titulo_pagina = retorne_titulo_pagina_id($pagina);

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// retorno nulo
	return null;
	
};

// retorna se o id de um item de tabela existe
if(retorne_id_existe($pagina, $tabela_banco[18]) == false){

	// array de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[316]);

	// retorno nulo
	return json_encode($array_retorno);
	
};

// usuario inscrito
$usuario_inscrito = retorne_usuario_inscrito_pagina($uid, $pagina);

// analiza configuracao de pagina
if(retorne_configuracao_pagina(retorne_idpagina_request(), 2) == false and $usuario_inscrito == false){

    // retorno nulo
    return null;

};

// analiza configuracao de pagina
if(retorne_configuracao_pagina(retorne_idpagina_request(), 3) == false){

    // valida se o usuario ja e inscrito na pagina
    if($usuario_inscrito == false){
		
        // retorno nulo
        return null;

	};
	
};

// valida pagina existe
if(retorne_pagina_existe($pagina) == false){
	
	// retorno nulo
	return null;
	
};

// valida usuario dono da pagina
// isto evita que o usuario se inscreva na propria pagina
if(retorne_usuario_dono_pagina($uid, $pagina) == true){
	
	// retorno nulo
	return null;
	
};

// valida usuario cadastrado
if($usuario_inscrito == false){
	
    // query
    $query = "insert into $tabela values(null, '$pagina', '$titulo_pagina', '$uid');";

	// adicionou a pagina
	$adicionou = 1;
	
}else{
	
	// query
    $query = "delete from $tabela where pagina='$pagina' and uidamigo='$uid';";
	
	// saiu da pagina
	$adicionou = 0;
	
	// limpa os dados de um usuario ao se desinscrever da pagina
	limpar_dados_usuario_desinscrever_pagina($pagina, $uid);
	
};

// inscrevendo usuario
plugin_executa_query($query);

// array de retorno
$array_retorno["dados"] = campo_inscrever_pagina($pagina, true);
$array_retorno["adicionou"] = $adicionou;

// retorno
return json_encode($array_retorno);

};

?>