<?php

// salva a url amigavel de perfil de usuario
function salvar_url_amigavel_usuario(){

// modo 0 usuario
// modo 1 pagina

// globals
global $idioma_sistema;
global $tabela_banco;

// nome
$nome = retorne_campo_formulario_request(31);
$modo = retorne_campo_formulario_request(6);

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(41, null, false);
$imagem_sistema[1] = retorne_imagem_sistema(42, null, false);

// id de pagina
$idpagina = retorne_idpagina_request();

// valida usuario logado dono de pagina
if($idpagina != null and $modo == 1 and retorne_usuario_logado_dono_pagina($idpagina) == false){
	
	// mensagem
	$mensagem[0] = "
	<div class='classe_mensagem_salvar_url_amigavel'>
	<div class='classe_mensagem_salvar_url_amigavel_1'>$imagem_sistema[1]</div>
	<div class='classe_mensagem_salvar_url_amigavel_2'>$idioma_sistema[399]</div>
	</div>
	";
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($mensagem[0]);

	// retorno
	return json_encode($array_retorno);
	
};

// valida o modo
if($modo == null){
	
	// setando modo padrao
	$modo = 0;
	
};

// uid
$uid = retorne_idusuario_logado();

// valida tamanho
if(strlen($nome) > TAMANHO_URL_AMIGAVEL or $nome == null or is_numeric($nome) == true){
	
	// mensagem
	$mensagem[0] = "
	<div class='classe_mensagem_salvar_url_amigavel'>
	<div class='classe_mensagem_salvar_url_amigavel_1'>$imagem_sistema[1]</div>
	<div class='classe_mensagem_salvar_url_amigavel_2'>$idioma_sistema[393]</div>
	</div>
	";
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($mensagem[0]);

	// retorno
	return json_encode($array_retorno);

};

// valida nome disponivel
if(retorne_nome_url_amigavel_existe($nome, $modo) == true){

	// valida ja esta usando nome
	if(retorne_nome_amigavel($nome) == retorne_somente_nome_amigavel_idusuario($uid, $modo, retorne_idpagina_request())){
		
		// mensagem
		$mensagem[0] = $idioma_sistema[396];
		
	}else{
		
		// mensagem
		$mensagem[0] = $idioma_sistema[392];
		
	};

	// mensagem
	$mensagem[0] = "
	<div class='classe_mensagem_salvar_url_amigavel'>
	<div class='classe_mensagem_salvar_url_amigavel_1'>$imagem_sistema[1]</div>
	<div class='classe_mensagem_salvar_url_amigavel_2'>$mensagem[0]</div>
	</div>
	";
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($mensagem[0]);

	// retorno
	return json_encode($array_retorno);
	
};

// nome amigavel
$nome = retorne_nome_amigavel($nome);

// tabela
$tabela = $tabela_banco[28];

// valida o modo
if($modo == 0){
	
	// query
	$query[0] = "delete from $tabela where uid='$uid' and modo='$modo';";

}else{

	// query
	$query[0] = "delete from $tabela where uid='$uid' and modo='$modo' and pagina='$idpagina';";
	
};

// query
$query[1] = "insert into $tabela values(null, '$uid', '$nome', '$modo', '$idpagina');";

// removendo dados antigos e salvando novos...
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);

// url amigavel
$url_amigavel = retorne_url_amigavel_usuario($uid, $modo, $idpagina);

// mensagem
$mensagem[0] = "
<div class='classe_mensagem_salvar_url_amigavel'>
<div class='classe_mensagem_salvar_url_amigavel_1'>$imagem_sistema[0]</div>
<div class='classe_mensagem_salvar_url_amigavel_2'>$idioma_sistema[395]</div>

<div class='classe_mensagem_salvar_url_amigavel_2'>
<span class='classe_span_2'>$url_amigavel</span>
</div>

</div>
";
	
// array retorno
$array_retorno["dados"] = mensagem_sucesso($mensagem[0]);

// retorno
return json_encode($array_retorno);

};

?>