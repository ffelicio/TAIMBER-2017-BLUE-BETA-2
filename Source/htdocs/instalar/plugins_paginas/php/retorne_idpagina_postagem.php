<?php

// retorna o id da pagina via id de postagem
function retorne_idpagina_postagem($id){

// dados
$dados = retorne_dados_publicacao($id);

// retorno
return $dados[PAGINA];

};

?>