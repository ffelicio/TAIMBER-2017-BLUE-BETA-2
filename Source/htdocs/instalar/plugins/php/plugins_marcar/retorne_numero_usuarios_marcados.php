<?php

// retorna o numero de usuarios marcados
function retorne_numero_usuarios_marcados($chave){

// retorno
return count(sessao_marcador_usuario_seta_retorna(null, null, $chave, null, 5));

};

?>