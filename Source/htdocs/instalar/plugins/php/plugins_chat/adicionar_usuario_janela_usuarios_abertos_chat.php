<?php

// adiciona um novo usuario aberto em janela de usuarios abertos de chat
function adicionar_usuario_janela_usuarios_abertos_chat(){

// globals
global $idioma_sistema;

// id de amigo
$uidamigo = retorne_campo_formulario_request(13);

// atualiza a sessao com usuarios abertos em chat
atualiza_sessao_usuarios_abertos_chat($uidamigo, 1);

// id de campos
$idcampo[0] = codifica_md5("id_usuario_janela_usuarios_abertos_chat_".$uidamigo);
$idcampo[1] = retorna_id_janela_usuario_janela_usuarios_abertos_chat($uidamigo);

// eventos
$evento[0] = "onclick='constroe_janela_chat(\"$uidamigo\", 1, \"$idcampo[1]\")';";

// imagem de perfil
$imagem_perfil = constroe_imagem_perfil_miniatura_amizade(false, false, false, $uidamigo);

// html
$html = "
<div class='classe_usuarios_abertos_chat classe_cor_2 classe_cor_5' id='$idcampo[1]' $evento[0]>
$imagem_perfil
</div>
";

// array com dados de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>