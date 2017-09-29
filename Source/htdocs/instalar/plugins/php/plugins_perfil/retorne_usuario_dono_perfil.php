<?php

// retorna se o usuario e o dono do perfil
function retorne_usuario_dono_perfil($uid){

// retorno
return $uid == retorne_idusuario_logado();

};

?>