<?php

// retorna campo de formulario via request
function retorne_campo_formulario_request_htmlentites($modo){

// globals
global $variavel_campo;

// retorno
return trata_html_requeste($_REQUEST[$variavel_campo[$modo]]);

};

?>