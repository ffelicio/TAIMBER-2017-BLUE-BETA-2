<?php

// campo envia mensagem
function campo_envia_mensagem($uid){

// globals
global $idioma_sistema;

// valida usuario dono
if($uid == retorne_idusuario_logado() or retorne_usuario_amigo($uid) == false){
	
	// retorno nulo
	return null;
	
};

// id de dialogo
$dialogo_id[0] = codifica_md5("id_dialogo_enviar_mensagem_$uid".data_atual());
$dialogo_id[1] = codifica_md5("id_dialogo_enviou_sucesso_mensagem_$uid".data_atual());

// ids de campos
$idcampo[0] = codifica_md5("id_campo_texto_mensagem_enviar_$uid".data_atual());

// funcoes
$funcao[0] = "mover_foco_elemento(\"$idcampo[0]\")";

// eventos
$eventos[0] = "onclick='exibe_dialogo(\"$dialogo_id[0]\"), $funcao[0];'";
$eventos[1] = "onclick='enviar_mensagem_usuario(\"13\", \"$uid\", \"$idcampo[0]\", \"$dialogo_id[0]\", \"$dialogo_id[1]\");'";

// nome de usuario logado
$nome_usuario_logado = retorne_nome_usuario_logado();

// nome de amigo que recebe a mensagem
$nome_amigo = retorne_nome_usuario(true, $uid);

// html
$html = "
$nome_usuario_logado$idioma_sistema[217]$nome_amigo$idioma_sistema[163]
";

// adiciona dialogo
$campo_dialogo[0] = constroe_dialogo($idioma_sistema[219], $html, $dialogo_id[1]);

// placeholder
$placeholder = "$nome_usuario_logado$idioma_sistema[214]$nome_amigo";

// campo de entrada
$campo_entrada = constroe_campo_div_editavel(true, $idcampo[0], null, null, null, $placeholder);

// campo de entrada
$campo_entrada = "
<div class='classe_campo_entrada_envia_mensagem_texto'>
$campo_entrada
</div>
";

// campos de emoticons
$campo_emoticons = constroe_visualizador_emoticons(true, false, true, $idcampo[0]);

// campos de emoticons
$campo_emoticons = "
<div class='classe_seleciona_emoticons_envia_mensagem'>
$campo_emoticons
</div>
";

// html
$html = "
$campo_entrada
$campo_emoticons

<div class='classe_campo_entrada_envia_mensagem_botao'>
<span class='botao_padrao' $eventos[1]>$idioma_sistema[215]</span>
</div>
";

// adiciona dialogo
$campo_dialogo[1] = constroe_dialogo_medio($idioma_sistema[216], $html, $dialogo_id[0]);

// imagem
$imagem[0] = retorne_imagem_sistema(85, null, false);

// html
$html = "
<div class='classe_campo_envia_mensagem'>

<div class='botao_enviar_mensagem botao_padrao' $eventos[0]>

<div class='botao_enviar_mensagem_imagem'>
$imagem[0]
</div>

<div class='botao_enviar_mensagem_texto'>
$idioma_sistema[215]
</div>

</div>

</div>

$campo_dialogo[0]
$campo_dialogo[1]
";

// retorno
return $html;

};

?>