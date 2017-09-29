<?php

// constroe o conteudo de janela de troca de mensagens de chat
function constroe_conteudo_janela_troca_mensagens_chat(){

// globals
global $idioma_sistema;

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(106, null, false);

// modo mobile
$modo_mobile = retorne_modo_mobile();

// id de amigo
$uidamigo = retorne_campo_formulario_request(13);

// obtem o id de amigo temporario para montar o formulario de upload
$_SESSION[SESSAO_UIDAMIGO_TEMP_CHAT] = retorne_campo_formulario_request(13);

// imagem de perfil
$imagem_perfil = constroe_imagem_perfil_miniatura(false, false, $uidamigo);

// id de campos
$idcampo[0] = codifica_md5("id_campo_entrada_envia_mensagem_chat_".data_atual().$uidamigo);
$idcampo[1] = PREFIXO_CHAT_USUARIO_ONLINE_2.$uidamigo;
$idcampo[2] = codifica_md5("id_formulario_upload_imagem_chat_".$uidamigo);

// funcoes
$funcao[0] = "ocultar_elementos_chat_digitar(\"0\", \"$idcampo[1]\")";
$funcao[1] = "ocultar_elementos_chat_digitar(\"1\", \"$idcampo[1]\")";
$funcao[2] = "enviar_mensagem_usuario(event.keyCode, \"$uidamigo\", \"$idcampo[0]\", null, null);";
$funcao[3] = "enviar_mensagem_usuario(13, \"$uidamigo\", \"$idcampo[0]\", null, null);";

// eventos
$eventos[0] = "onkeydown='$funcao[2]'";

// valida o modo mobile
if($modo_mobile == true){
	
	// funcoes
	$eventos[1] = "onfocus='$funcao[0]'";
	$eventos[2] = "onblur='$funcao[1]'";

};

// eventos
$eventos[4] = "onclick='$funcao[3]'";

// campo com emoticons
$campo_emoticons = constroe_visualizador_emoticons(true, true, true, $idcampo[0]);
	
// campo com emoticons
$campo_emoticons = "
<div class='classe_novo_chat_usuario_emoticons'>
$campo_emoticons
</div>
";

// campo enviar
$campo_enviar = "
<div class='classe_campo_enviar_mensagem_chat' $eventos[4]>
$imagem_sistema[0]
</div>
";

// valida o modo mobile
if($modo_mobile == true){
	
	// eventos
	$eventos[3] = "onkeypress='$funcao[0]'";

};

// campo de entrada
$campo_entrada = constroe_campo_div_editavel(true, $idcampo[0], null, null, "$eventos[0] $eventos[1] $eventos[2] $eventos[3]", $idioma_sistema[231]);

// campo opcoes
$campo_opcoes = campo_opcoes_janela_troca_mensagens_chat($uidamigo);

// campo de upload de imagem
$campo_upload_imagem = constroe_formulario_barra_progresso_postagem(PAGINA_ACOES, $idcampo[2], "fotos[]", 51, true, 1, "");

// html
$html = "
<div class='classe_novo_chat_usuario'>
$campo_opcoes

<div class='classe_novo_chat_usuario_topo borda_div_3'>
$imagem_perfil
</div>

<div class='classe_novo_chat_usuario_mensagens cor_borda_div classe_cor_22 borda_div_3' id='$idcampo[1]'></div>

<div class='classe_novo_chat_usuario_entrada'>
$campo_entrada
$campo_emoticons
$campo_enviar
</div>

<div class='classe_novo_chat_usuario_upload_imagem'>
$campo_upload_imagem
</div>

</div>
";

// seta a mensagem como visualizada
seta_mensagem_visualizada($uidamigo);

// limpa id de amigo temporario
$_SESSION[SESSAO_UIDAMIGO_TEMP_CHAT] = null;

// atualiza o array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>