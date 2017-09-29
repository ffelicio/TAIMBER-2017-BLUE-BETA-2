<?php

// constroe o campo de publicacao
function constroe_campo_publicar(){

// globals
global $idioma_sistema;
global $tabela_banco;

// id de pagina
$pagina = retorne_idpagina_request();

// id de usuario logado
$uid = retorne_idusuario_logado();

// campo com publicacoes
$campo_publicacoes = constroe_campo_exibe_publicacoes(retorne_idcampo_geral_novas_publicacoes());

// valida se pode exibir o campo de publicao
if(retorne_pode_exibir_campo_publicar() == false){
	
	// retorno
	return $campo_publicacoes;
	
};

// modo mobile
$modo_mobile = retorne_modo_mobile();

// valida pagina
if($pagina != null){
	
	// classes
	$classe[0] = "borda_div_5";

};

// id de campos
$idcampo[1] = retorne_idcampo_textarea_publicar_postagem();
$idcampo[2] = "id_campo_numero_publicacoes";
$idcampo[3] = retorne_idcampo_geral_novas_publicacoes();
$idcampo[4] = "id_div_campo_publicacao_usuario";
$idcampo[5] = "id_campo_progresso_gif_publicacao";
$idcampo[6] = retorne_idcampo_md5();
$idcampo[7] = retorne_idcampo_md5();

// funcoes
$funcao[0] = "publicar_conteudo(\"$idcampo[1]\", \"$idcampo[3]\", \"$idcampo[4]\", \"$idcampo[5]\", \"$pagina\", \"$idcampo[6]\", \"$idcampo[7]\");";

// eventos
$evento[0] = "onclick='$funcao[0]'";

// campo progresso gif
$campo_progresso_gif[0] = campo_progresso_gif($idcampo[5]);

// valida pagina
if($pagina == null){

	// numero de publicacoes
	$numero_publicacoes = retorne_numero_publicacoes($uid);
	
}else{
	
	// numero de publicacoes
	$numero_publicacoes = retorne_numero_publicacoes_pagina($pagina);
	
};

// singular ou plural
if($numero_publicacoes > 1){
	
	// plural
	$numero_publicacoes = retorne_tamanho_resultado($numero_publicacoes);
	
	// campo publicacoes
	$numero_publicacoes = "
	<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
	<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[519]</div>
	";
	
}else{

	// campo publicacoes
	$numero_publicacoes = "
	<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
	<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[518]</div>
	";
	
};

// campo de upload de imagem
$campo_upload_imagem = constroe_formulario_barra_progresso_postagem(PAGINA_ACOES, "id_formulario_upload_publicacao", "fotos[]", 124, true, 1, "executador_acao(null, 10, \"id_div_exibe_imagens_upload_publicacao\");");

// campo marcar
$campo_marcar = constroe_campo_marcar($idcampo[1], retorna_seta_chave_publicacao(false), null, $tabela_banco[5]);

// campo emoticons
$campo_emoticons = constroe_visualizador_emoticons(true, false, true, $idcampo[1]);

// constroe campo anexar em publicacao
$campo_anexar = constroe_campo_anexar_publicacao();

// campo pre visualizar musicas de publicacao
$campo_previsualizar_musicas = constroe_campo_previsualizar_musicas_publicacao();

// campo pre visualizar videos de publicacao
$campo_previsualizar_videos = constroe_campo_previsualizar_videos_publicacao();

// campo adicionar link
$campo_addlink = constroe_adicionar_conteudo_url($idcampo[1], $idcampo[6], $idcampo[7]);

// campo previsualizar conteudo de url
$campo_previsualizar_conteudo_url = "
<div class='classe_previsualizar_conteudo_url' id='$idcampo[6]'></div>
";

// valida modo pagina
if(retorne_modo_pagina() == false){
	
	// campos
	$campo[0] = constroe_imagem_perfil_miniatura_publicacao(false, $uid);

}else{
	
	// campos
	$campo[0] = constroe_imagem_perfil_miniatura_pagina($pagina);
	
};

// campos
$campo[0] = "
<div class='campo_imagem_perfil_campo_publicar'>
$campo[0]
</div>
";

// classes
$classe[1] = "classe_div_campo_publicar_separa";

// campos
$campo[1] = "

<div class='$classe[1]'>
$campo_anexar
</div>

<div class='$classe[1]'>
$campo_emoticons
</div>

<div class='$classe[1]'>
$campo_addlink
</div>

<div class='$classe[1]'>
$campo_marcar
</div>

";

// campos
$campo[2] = "

<div class='classe_div_numero_publicacoes' id='$idcampo[2]'>
$numero_publicacoes
</div>

";

// valida o modo mobile
if($modo_mobile == false){
	
	// campos
	$campo[3] = "

	<div class='classe_div_campo_opcoes_publicar_perfil'>
	$campo[0]
	$campo[2]
	</div>

	";

};

// campos
$campo[4] = constroe_campo_div_editavel($modo_mobile, $idcampo[1], null, "classe_div_campo_publicar_texto_entrada", null, $idioma_sistema[25]);

// campos
$campo[4] = "
<div class='classe_div_campo_publicar_texto'>
$campo[4]
</div>
";

// campos
$campo[5] = "
<div class='classe_div_campo_publicar_postar'>

<span class='botao_padrao' $evento[0]>
$idioma_sistema[26]
</span>

</div>
";

// campos
$campo[6] = "
<div class='classe_div_campo_publicar_opcoes_postagem'>

<div class='classe_div_exibe_imagens_upload_publicacao' id='id_div_exibe_imagens_upload_publicacao'>
</div>

$campo_previsualizar_musicas
$campo_previsualizar_videos
$campo_previsualizar_conteudo_url

<div class='classe_div_campo_opcoes_publicar'>

<div class='classe_div_campo_publicar_imagens'>
$campo_upload_imagem
</div>

</div>

$campo[5]

</div>
";



// campo publicar
$campo_publicar = "
<div class='classe_div_campo_publicar $classe[0]' id='$idcampo[4]'>

$campo[3]

<div class='classe_div_campo_opcoes_publicar_centro'>
$campo[1]
$campo[4]
$campo[6]
</div>

</div>
";

// html
$html = "
$campo_publicar
$campo_progresso_gif[0]
$campo_publicacoes
";

// retorno
return $html;

};

?>
