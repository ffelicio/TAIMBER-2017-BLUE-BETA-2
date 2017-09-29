<?php

// constroe o campo curtir
function constroe_campo_curtir($tipo_campo, $id, $modo, $idusuario){

// globals
global $idioma_sistema;

// valida tipo de campo
switch($tipo_campo){
	
	case 1:
	
	// valida modo pode interagir social
	if(retorne_pode_interagir_social($id, false) == false){
		
		// retorno nulo
		return null;
		
	};
	
	break;
	
	case 2:
	
	// valida usuario amigo
	if(retorne_usuario_amigo($idusuario) == false and retorne_usuario_dono_perfil($idusuario) == false and retorne_idpagina_request() == null){
		
		// retorno nulo
		return null;
		
	};
	
	break;

};

// valida configuracao de pagina
if(retorne_idpagina_request() != null){
	
	// analiza configuracao de pagina
	if(retorne_configuracao_pagina(retorne_idpagina_request(), 1) == false){
		
		// retorno
		return null;
		
	};

};

// nome do usuario logado
$nome = retorne_nome_usuario_logado();

// valida configuracao de privacidade
if(retorna_configuracao_privacidade(6, $idusuario) == true){

	// retorno nulo
	return null;
	
};

// valida modo
if($modo == false){
	
	// tipo de campo
	$tipo_campo = retorne_tabela_comentario($tipo_campo);

};

// valida usuario curtiu publicacao
if(retorne_usuario_curtiu($tipo_campo, $id) == true){
	
	// campo curtir
	$campo[0] = retorne_imagem_sistema(10, null, false);

	// imagem de sistema
	$imagem_sistema[0] = retorne_imagem_sistema(9, null, false);
	
}else{
	
	// campo curtir
	$campo[0] = retorne_imagem_sistema(9, null, false);

	// imagem de sistema
	$imagem_sistema[0] = retorne_imagem_sistema(10, null, false);
	
};

// numero de curtidas
$numero_curtidas = retorne_tamanho_resultado(retorne_numero_curtidas($tipo_campo, $id));

// campo curtir
$campo_curtir = "

<div class='classe_campo_curtir_separa classe_cor_4'>
<span class='classe_campo_curtir_separa_span_1'>$campo[0]</span>
<span class='classe_campo_curtir_separa_span_2 span_link'>$numero_curtidas</span>
</div>

";

// valida modo
if($modo == false){

    // array com dados de retorno
    $array_retorno["dados"] = $campo_curtir;
	
	// retorno
	return $array_retorno;
	
};

// id de campo
$id_campo[0] = codifica_md5("campo_curtir_".$tipo_campo."_".$id.retorne_contador_iteracao());

// eventos
$evento[0] = "onclick='curtir(\"$tipo_campo\", \"$id\", \"$id_campo[0]\", \"$idusuario\");'";

// html
$html = "
<div class='classe_campo_curtir' id='$id_campo[0]' $evento[0]>
$campo_curtir
</div>
";

// retorno
return $html;

};

?>