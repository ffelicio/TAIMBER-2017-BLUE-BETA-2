<?php

// constroe o conteudo de janela de troca de mensagens de mensageiro
function constroe_conteudo_janela_troca_mensagens_mensageiro(){

// globals
global $idioma_sistema;

// modo mobile
$modo_mobile = retorne_modo_mobile();

// nome de usuario
$nome_usuario = retorne_nome_usuario_logado();

// id de amigo
$uidamigo = retorne_campo_formulario_request(13);

// obtem o id de amigo temporario para montar o formulario de upload
$_SESSION[SESSAO_UIDAMIGO_TEMP_CHAT] = retorne_campo_formulario_request(13);

// atualiza o uidamigo de mensageiro
$_SESSION[SESSAO_UIDAMIGO_TEMP_MENSAGEIRO] = retorne_campo_formulario_request(13);

// imagem de perfil
$imagem_perfil = constroe_imagem_perfil_miniatura(false, false, $uidamigo);

// id de campos
$idcampo[0] = codifica_md5("id_campo_entrada_envia_mensagem_chat_".data_atual().$uidamigo);
$idcampo[1] = PREFIXO_CHAT_USUARIO_ONLINE_2.$uidamigo;
$idcampo[2] = codifica_md5("id_formulario_upload_imagem_chat_".$uidamigo);
$idcampo[3] = retorne_idcampo_md5();

// eventos
$eventos[0] = "onkeydown='enviar_mensagem_usuario(event.keyCode, \"$uidamigo\", \"$idcampo[0]\", null, null);'";

// campo emoticons	
$campo_emoticons = constroe_visualizador_emoticons(false, true, true, $idcampo[0]);
	
// campo com emoticons
$campo_emoticons = "
<div class='classe_novo_chat_usuario_emoticons_mensageiro'>
$campo_emoticons
</div>
";

// valida o modo mobile
if($modo_mobile == true){
	
	// eventos
	$eventos[3] = "onkeypress='$funcao[0]'";

};

// campo de entrada
$campo_entrada = constroe_campo_div_editavel(true, $idcampo[0], null, null, "$eventos[0] $eventos[3]", $idioma_sistema[231]);

// campo de upload de imagem
$campo_upload_imagem = constroe_formulario_barra_progresso_postagem(PAGINA_ACOES, $idcampo[2], "fotos[]", 51, true, 1, "");

// valida o modo mobile
if($modo_mobile == true){
	
	// imagens de sistema
	$imagem_sistema[0] = retorne_imagem_sistema(94, null, false);
	$imagem_sistema[1] = retorne_imagem_sistema(95, null, false);
	
	// eventos
	$eventos[1] = "onclick='resetar_amigos_mensageiro();'";
	$eventos[2] = "onclick='exibe_dialogo(\"$idcampo[3]\");'";
	$eventos[3] = "onclick='excluir_mensagem_usuario(null, null, \"$uidamigo\", \"1\"), exibe_elemento_oculto(\"$idcampo[3]\", null);'";
	
	// texto
	$texto[0] = $nome_usuario.$idioma_sistema[528];
	
	// campo excluir
	$campo_excluir = "

	<div class='classe_texto_caixa_dialogo'>
	$texto[0]
	</div>

	<div class='classe_botao_caixa_dialogo'>
	<input type='button' value='$idioma_sistema[32]' $eventos[3]>
	</div>

	";
	
	// campo excluir
	$campo_excluir = constroe_dialogo($idioma_sistema[268], $campo_excluir, $idcampo[3]);

	// campos
	$campos[0] = "
	<div class='classe_novo_chat_usuario_mensageiro_acessa_amigos classe_cor_2'>
	
	<span $eventos[1]>$imagem_sistema[0]</span>
	<span $eventos[2]>$imagem_sistema[1]</span>
	
	</div>
	
	$campo_excluir
	";

};

// eventos
$eventos[4] = "onclick='enviar_mensagem_usuario(13, \"$uidamigo\", \"$idcampo[0]\", null, null);'";

// campo enviar
$campo_enviar = "
<div class='classe_campo_enviar_mensagem_mensageiro'>
<span class='botao_padrao' $eventos[4]>$idioma_sistema[439]</span>
</div>
";

// html
$html = "

$campos[0]

<div class='classe_novo_chat_usuario_mensageiro_topo classe_cor_2'>

<div class='classe_novo_chat_usuario_mensageiro_topo_imagem_perfil'>
$imagem_perfil
</div>

</div>

<div class='classe_novo_chat_usuario_mensageiro_entrada_campos'>

<div class='classe_novo_chat_usuario_mensagens_mensageiro' id='$idcampo[1]'></div>

<div class='classe_novo_chat_usuario_entrada_mensageiro classe_cor_10'>
$campo_entrada
</div>

<div class='classe_campo_opcoes_mensagem_mensageiro'>

<div class='classe_novo_chat_usuario_upload_imagem_mensageiro'>
$campo_upload_imagem
</div>

$campo_emoticons
$campo_enviar

</div>

</div>

";

// limpa id de amigo temporario
$_SESSION[SESSAO_UIDAMIGO_TEMP_CHAT] = null;

// atualiza o array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>