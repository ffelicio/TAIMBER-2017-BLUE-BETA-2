<?php

// retorna o id de janela principal de chat
function retorne_id_janela_principal_chat(){

// retorno
return codifica_md5("janela_chat_".PREFIXO_JANELA_PRINCIPAL_CHAT);

};

?>