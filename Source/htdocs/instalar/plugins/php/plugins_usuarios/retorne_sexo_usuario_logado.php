<?php

// retorna o sexo do usuario logado
function retorne_sexo_usuario_logado(){

// retorno
return retorne_sexo_usuario(retorne_dados_perfil_usuario(retorne_idusuario_logado()));

};

?>