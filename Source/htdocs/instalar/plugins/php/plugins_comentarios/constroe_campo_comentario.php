<?php

// constroe o campo de comentario
function constroe_campo_comentario($tabela_comentario, $tipo_campo, $id, $modo, $idusuario){

// globals
global $idioma_sistema;
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

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
	
	case 3:
	
	// valida se pode responder comentario
	if(retorne_pode_responder_comentario($id) == false and retorne_idpagina_request() == null){
		
		// retorno nulo
		return null;
		
	};
	
	break;

};

// valida configuracao de pagina
if(retorne_idpagina_request() != null){
	
	// analiza configuracao de pagina
	if(retorne_configuracao_pagina(retorne_idpagina_request(), 0) == false){
		
		// retorno
		return null;
		
	};

};

// define a chave
$chave = codifica_md5("id_campo_comentario_".$tipo_campo.$id.$modo.$idusuario.data_atual());

// nome do usuario logado
$nome = retorne_nome_usuario_logado();

// valida configuracao de privacidade
if(retorna_configuracao_privacidade(5, $idusuario) == true){

	// retorno nulo
	return null;
	
};

// valida o tipo de comentario
switch($tipo_campo){

    case 1:
	// placeholder
	$placeholder = $nome.$idioma_sistema[73];
	
	// classes
	$classe[0] = "classe_div_campo_comentario_perfil";
	$classe[2] = "classe_div_campo_comentario_campo_entrada";
	$classe[3] = "classe_div_campo_comentario_campo_opcoes";
	$classe[4] = null;
	
    break;
	
	case 2:
	
	// placeholder
	$placeholder = $nome.$idioma_sistema[74];
	
	// classes
	$classe[0] = "classe_div_campo_comentario_perfil_album";
	$classe[2] = "classe_div_campo_comentario_campo_entrada_album";
	$classe[3] = "classe_div_campo_comentario_campo_opcoes_album";
	$classe[4] = "classe_visualizador_comentarios_scroll";
	
	break;
	
	case 3:
	
	// placeholder
	$placeholder = $nome.$idioma_sistema[345];
	
	// classes
	$classe[0] = "classe_div_campo_comentario_perfil_responde";
	$classe[2] = "classe_div_campo_comentario_campo_entrada_responde";
	$classe[3] = "classe_div_campo_comentario_campo_opcoes_responde";
	$classe[4] = null;
	
	// modo responder
	$modo_responder = true;
	
	break;
	
};

// valida tabela de comentario
switch($tabela_comentario){
	
	case $tabela_banco[4]:
	
	$classe[0] = "classe_div_campo_comentario_perfil_responde_album";
	$classe[2] = "classe_div_campo_comentario_campo_entrada_responde_album";
	$classe[3] = "classe_div_campo_comentario_campo_opcoes_responde_album";
	
	break;

};

// id campo entrada de comentario
$id_campo_entrada_comentario = codifica_md5("id_campo_entrada_comentario".$tipo_campo.$id.$modo.retorne_contador_iteracao());

// id de visualizador de comentarios
$id_visualizador_comentarios = codifica_md5("id_visualizador_comentarios".$tipo_campo.$id.$modo.retorne_contador_iteracao());

// id de campo com numero de comentarios
$id_campo_numero_comentarios = codifica_md5("id_campo_numero_comentarios".$tipo_campo.$id.$modo.retorne_contador_iteracao());

// id de campo paginar comentarios
$id_campo_paginar_comentarios = codifica_md5("id_campo_paginar_comentarios".$tipo_campo.$id.$modo.retorne_contador_iteracao());

// id de campos
$idcampo[0] = codifica_md5("id_campo_responder_comentario_span_".$tipo_campo.$id.$modo.retorne_contador_iteracao());
$idcampo[1] = codifica_md5("id_campo_responder_comentario_".$tipo_campo.$id.$modo.retorne_contador_iteracao());
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();
$idcampo[4] = retorne_idcampo_md5();

// barra de progresso
$barra_progresso[0] = campo_progresso_gif($idcampo[4]);

// funcoes
$funcao[0] = "carregar_comentarios(\"$tipo_campo\", \"$id\", \"$id_visualizador_comentarios\", \"$id_campo_paginar_comentarios\", \"$idcampo[4]\")";
$funcao[1] = "exibir_responder_comentario(\"$idcampo[0]\", \"$idcampo[1]\")";
$funcao[2] = "exibe_elemento_oculto(\"$idcampo[2]\", 3)";
$funcao[3] = "postar_comentario(\"$id_campo_entrada_comentario\", \"$id_visualizador_comentarios\", \"$tipo_campo\", \"$id\", \"$id_campo_numero_comentarios\", \"$id_campo_paginar_comentarios\", \"$idusuario\", \"$idcampo[3]\");";

// evento
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onkeydown='if(event.keyCode == 13){$funcao[3]}'";
$evento[2] = "onclick='$funcao[0], $funcao[1]'";
$evento[3] = "onscroll='$funcao[0]'";
$evento[4] = "onclick='$funcao[0], $funcao[2]'";
$evento[5] = "onclick='$funcao[3]'";

// campo para responder comentario no modo mobile
$campo_responde_mobile = "
<div class='classe_responde_comentario_mobile'>
	
	<span class='span_link' $evento[5]>
		$idioma_sistema[611]
	</span>
	
</div>
";

// numero de comentarios
$numero_comentarios = retorne_tamanho_resultado(retorne_numero_comentarios($tipo_campo, $id));

// campo marcar
$campo_marcar = constroe_campo_marcar($id_campo_entrada_comentario, $chave, $id, $tabela_banco[7]);

// campo de emoticons
$campo[1] = constroe_visualizador_emoticons(true, false, true, $id_campo_entrada_comentario);

// adiciona separador
$campo[1] = "
<div class='classe_separa_item_campo_comentario'>$campo[1]</div>
";

// valida modo responder
if($modo_responder == false){
	
	// campos extras
	$campo_extra[0] = constroe_imagem_perfil_miniatura_publicacao(false, $uid);

	// campos extras
	$campo_extra[0] = "

	<div class='$classe[0]'>
	$campo_extra[0]
	</div>

	";

};

// campo entrada
$campo_entrada = constroe_campo_div_editavel(true, $id_campo_entrada_comentario, null, "classe_entrada_campo_comentario", $evento[1], $placeholder);

// campo entrada
$campo_entrada = "
<div class='$classe[2]'>
$campo_entrada
</div>
";

// campo comentario
$campo[2] = "

<div class='classe_div_comentar_numeros span_link' id='$id_campo_numero_comentarios' $evento[2]>
$idioma_sistema[75]$idioma_sistema[76]$numero_comentarios$idioma_sistema[77]
</div>

<div class='classe_div_campo_comentario'>

$campo_extra[0]

$campo_entrada
$campo_responde_mobile

<div class='$classe[3]'>
$campo[1]
$campo_marcar
</div>

</div>


<div class='classe_visualizador_comentarios $classe[4]' id='$id_visualizador_comentarios' $evento[3]></div>

$barra_progresso[0]

<span class='classe_campo_paginar_comentarios span_link' id='$id_campo_paginar_comentarios' $evento[0]>
$idioma_sistema[81]
</span>

";

// valida resposta de comentario
if($tipo_campo == 3){
	
	// classe
	$classe[1] = "classe_campo_comentario_entrada_2";
	
	// adiciona responder comentario
	$campo[2] = "
	
	<div class='classe_campo_responde_comentario_span' id='$idcampo[0]' $evento[2]>
	<span class='span_link'>$idioma_sistema[346] ($numero_comentarios)</span>
	</div>
	
	<div class='classe_campo_responde_comentario cor_borda_div classe_cor_4' id='$idcampo[1]'>
	$campo[2]
	</div>
	
	";
	
}else{
	
	// classe
	$classe[1] = "classe_campo_comentario_entrada";

};

// valida o tipo de campo
if($tipo_campo != 3){
	
	// imagem
	$imagem[0] = retorne_imagem_sistema(90, null, false);

	// campos
	$campo[3] = "
	<div class='classe_campo_comentario classe_cor_4' $evento[4]>
	<span class='classe_campo_comentario_separa_1'>$imagem[0]</span>

	<span class='classe_campo_comentario_separa_2 span_link' id='$idcampo[3]'>
	$numero_comentarios
	</span>

	</div>
	";

};

// html
$html = "
$campo[3]

<div class='$classe[1]' id='$idcampo[2]'>
$campo[2]
</div>
";

// retorno
return $html;

};

?>