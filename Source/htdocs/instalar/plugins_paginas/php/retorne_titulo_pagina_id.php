<?php

// retorna o titulo da pagina
function retorne_titulo_pagina_id($id){

// dados do perfil da pagina
$dados = retorne_dados_perfil_pagina($id);

// retorno
return $dados[TITULO_DA_PAGINA];

};

?>