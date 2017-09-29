<?php

// constroe o campo de anexar videos
function constroe_campo_anexar_videos($modo, $menu_id){

// modo true anexa video em publicacao
// modo false anexa video sem publicacao

// globals
global $idioma_sistema;
global $variavel_campo;

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// id de campo
$idcampo[0] = codifica_md5("id_formulario_upload_video_".retorne_contador_iteracao());
$idcampo[1] = codifica_md5("id_dialogo_upload_video_".retorne_contador_iteracao());
$idcampo[2] = retorne_idcampo_previsualiza_videos_publicacao();

// imagem de usuario logado
$imagem_usuario = retorne_imagem_sexo_usuario(false, null, retorne_idusuario_logado());

// funcoes
$funcao[0] = "exibe_dialogo(\"$idcampo[1]\")";
$funcao[1] = "previsualiza_videos_publicacao(\"$idcampo[2]\")";
$funcao[2] = "fechar_menu_suspense(\"$menu_id\")";

// eventos
$evento[0] = "onclick='$funcao[0];'";

// valida modo
if($modo == true){

	// formulario de upload de video
	$formulario_upload = constroe_formulario_barra_progresso_postagem(PAGINA_ACOES, $idcampo[0], $variavel_campo[43], 80, false, 3, "$funcao[0], $funcao[2], $funcao[1];");

}else{

	// formulario de upload de video
	$formulario_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, $idcampo[0], $variavel_campo[43], 80, false, 3);

};

// campo de upload de video
$formulario_upload = "

<div class='classe_div_campo_upload_video'>
$formulario_upload
</div>

";

// campo de upload de video
$campo_upload[0] = constroe_caixa_descritiva($idioma_sistema[354], $nome_usuario.$idioma_sistema[372], $imagem_usuario);

// campo de upload de video
$campo_upload[0] .= $formulario_upload;

// adiciona dialogo em upload de video
$campo_upload[0] = constroe_dialogo($idioma_sistema[371], $campo_upload[0], $idcampo[1]);

// valida o modo
if($modo == true){

	// texto
	$texto[0] = $idioma_sistema[371];

	// campos
	$campo[0] = "
	<div class='classe_div_opcao_menu_suspense'>
	<span class='span_link' $evento[0]>$texto[0]</span>
	</div>
	";

}else{

	// texto
	$texto[0] = retorne_imagem_sistema(111, null, false);

	// campos
	$campo[0] = "
	<span class='classe_visualizador_videos_perfil_basico_add_span span_link' $evento[0]>
	$texto[0]
	</span>
	";

};

// array de retorno
$array_retorno["html"] = $campo[0];
$array_retorno["dialogo"] = $campo_upload[0];

// retorno
return $array_retorno;

};

?>