<?php

// retorna o numero de usuarios abertos em chat
function retorne_numero_usuarios_abertos_chat(){

// retorno
return retorne_tamanho_resultado(count(atualiza_sessao_usuarios_abertos_chat(null, 3)));

};

?>