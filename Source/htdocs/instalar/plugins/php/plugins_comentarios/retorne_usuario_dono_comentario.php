<?php

// retorna se o usuario e dono do comentario
function retorne_usuario_dono_comentario($uid){

// retorno
return $uid == retorne_idusuario_logado();

};

?>