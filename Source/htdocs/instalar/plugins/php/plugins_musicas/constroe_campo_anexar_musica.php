<?php

// constroe campo anexar musica
function constroe_campo_anexar_musica($modo, $menu_id){

// modo true anexa musica em publicacao
// modo false anexa musica sem publicacao

// globals
global $idioma_sistema;
global $variavel_campo;

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// id de campo
$idcampo[0] = codifica_md5("id_formulario_upload_musica_".retorne_contador_iteracao());
$idcampo[1] = codifica_md5("id_dialogo_upload_musica".retorne_contador_iteracao());
$idcampo[2] = retorne_idcampo_previsualiza_musicas_publicacao();

// imagem de usuario logado
$imagem_usuario = retorne_imagem_sexo_usuario(false, null, retorne_idusuario_logado());

// funcoes
$funcao[0] = "exibe_dialogo(\"$idcampo[1]\")";
$funcao[1] = "fechar_menu_suspense(\"$menu_id\")";
$funcao[2] = "previsualiza_musicas_publicacao(\"$idcampo[2]\")";
$funcao[3] = "exibe_elemento_oculto(\"$idcampo[2]\", 0);";

// eventos
$evento[0] = "onclick='$funcao[0];'";

// valida modo
if($modo == true){

	// formulario de upload de musica
	$formulario_upload = constroe_formulario_barra_progresso_postagem(PAGINA_ACOES, $idcampo[0], $variavel_campo[41], 76, false, 2, "$funcao[0], $funcao[1], $funcao[2], $funcao[3]");

}else{

	// formulario de upload de musica
	$formulario_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, $idcampo[0], $variavel_campo[41], 76, false, 2);

};

// campo de upload de musica
$formulario_upload = "

<div class='classe_div_campo_upload_musica'>
$formulario_upload
</div>

";

// campo de upload de musica
$campo_upload[0] = constroe_caixa_descritiva($idioma_sistema[354], $nome_usuario.$idioma_sistema[353], $imagem_usuario);

// campo de upload de musica
$campo_upload[0] .= $formulario_upload;

// adiciona dialogo em upload de musica
$campo_upload[0] = constroe_dialogo($idioma_sistema[351], $campo_upload[0], $idcampo[1]);

// valida o modo
if($modo == true){

	// texto
	$texto[0] = $idioma_sistema[351];

	// campos
	$campo[0] = "
	<div class='classe_div_opcao_menu_suspense'>
	<span class='span_link' $evento[0]>$texto[0]</span>
	</div>
	";

}else{

	// texto
	$texto[0] = retorne_imagem_sistema(63, null, false);

	// campos
	$campo[0] = "
	<span class='classe_visualizador_musicas_perfil_basico_add_span' $evento[0]>
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