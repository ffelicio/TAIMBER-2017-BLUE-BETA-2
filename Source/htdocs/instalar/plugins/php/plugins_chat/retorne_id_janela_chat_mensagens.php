<?php

// retorne o id da janela de mensagens de chat
function retorne_id_janela_chat_mensagens(){

// retorno
return codifica_md5("id_janela_chat_mensagens_".retorne_idusuario_logado().data_atual());

};

?>