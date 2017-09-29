<?php

// retorne o novo id da janela de troca de mensagens de chat
function retorne_novo_id_janela_chat_mensagens(){

// retorno
return codifica_md5("novo_id_janela_chat_mensagens_".data_atual().retorne_idusuario_logado());

};

?>