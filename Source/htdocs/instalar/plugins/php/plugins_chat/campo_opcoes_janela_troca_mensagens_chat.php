<?php

// campo opcoes de janela de troca de mensagens de chat de usuario
function campo_opcoes_janela_troca_mensagens_chat($uidamigo){

// globals
global $idioma_sistema;

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(98, null, false);
$imagem_sistema[1] = retorne_imagem_sistema(16, null, false);

// id de campo
$idcampo[0] = retorna_id_janela_usuario_janela_usuarios_abertos_chat($uidamigo);
$idcampo[1] = codifica_md5("id_menu_suspense_opcoes_janela_troca_mensagens_chat_".$uidamigo);
$idcampo[2] = PREFIXO_CHAT_USUARIO_ONLINE_5.$uidamigo;

// eventos
$eventos[0] = "onclick='fechar_janela_chat(\"$uidamigo\", \"$idcampo[0]\");'";
$eventos[1] = "onclick='excluir_mensagem_usuario(null, null, \"$uidamigo\", \"1\"), exibe_elemento_oculto(\"$idcampo[1]\", null);'";

// campos
$campo[0] = "
<div class='classe_div_opcao_menu_suspense' id='$idcampo[2]' $eventos[1]>
<span class='span_link'>$idioma_sistema[268]</span>
</div>
";

// adiciona o menu de suspense
$campo[0] = constroe_menu_suspense(false, null, false, 125, $idcampo[1], $campo[0]);

// campo usuario online
$campo[1] = "
<div class='classe_opcoes_janela_troca_mensagens_chat_div_3' id='$idcampo[2]'>
$imagem_sistema[1]
</div>
";

// html
$html = "
<div class='classe_opcoes_janela_troca_mensagens_chat classe_cor_1'>

$campo[1]

<div class='classe_opcoes_janela_troca_mensagens_chat_div_1' $eventos[0]>
$imagem_sistema[0]
</div>

<div class='classe_opcoes_janela_troca_mensagens_chat_div_2'>
$campo[0]
</div>

</div>
";

// retorno
return $html;

};

?>