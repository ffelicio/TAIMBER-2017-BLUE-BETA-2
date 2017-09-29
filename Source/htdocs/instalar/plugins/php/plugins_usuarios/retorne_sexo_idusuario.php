<?php

// retorna o sexo do perfil atual
function retorne_sexo_idusuario($uid){

// retorno
return retorne_sexo_usuario(retorne_dados_perfil_usuario($uid));

};

?>