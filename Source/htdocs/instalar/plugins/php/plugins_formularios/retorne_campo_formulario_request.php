<?php

// retorna campo de formulario via request
function retorne_campo_formulario_request($modo){

// globals
global $variavel_campo;

// retorno
return remove_html($_REQUEST[$variavel_campo[$modo]]);

};

?>