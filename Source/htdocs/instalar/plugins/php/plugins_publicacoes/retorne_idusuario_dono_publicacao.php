<?php

// retorna o id de usuario dono da publicacao
function retorne_idusuario_dono_publicacao($id){

// dados de publicacao
$dados = retorne_dados_publicacao($id);

// retorno
return $dados[UID];

};

?>