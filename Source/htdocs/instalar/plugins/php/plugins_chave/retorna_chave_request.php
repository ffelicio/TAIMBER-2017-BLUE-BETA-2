<?php

// retorna a chave via request
function retorna_chave_request(){

// globals
global $variavel_campo;

// retorno
return remove_html($_REQUEST[$variavel_campo[3]]);

};

?>