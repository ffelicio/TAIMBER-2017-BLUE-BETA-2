<?php

// retorna se o usuario logado e o dono da pagina
function retorne_usuario_logado_dono_pagina($id){

// retorno
return retorne_usuario_dono_pagina(retorne_idusuario_logado(), $id);

};

?>