<?php

// retorna o id de janela de usuario aberto em janela de usuarios abertos do chat
function retorna_id_janela_usuario_janela_usuarios_abertos_chat($uid){

// retorno
return codifica_md5(PREFIXO_CHAT_ID_JANELA_USUARIO_ABERTO_LISTA.$uid);

};

?>