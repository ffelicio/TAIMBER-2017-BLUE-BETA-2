<?php

// constroe o visualizador de amigos de usuario
function constroe_visualizar_amigos_usuario(){

// campo visualizar amigos
$campo[0] = campo_visualizar_amigos_usuario();

// retorno
return constroe_conteudo_padrao(true, $campo[0]["campo_conteudo"], null);

};

?>