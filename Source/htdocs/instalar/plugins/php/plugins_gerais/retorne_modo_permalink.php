<?php

// retorna se esta no modo permalink
function retorne_modo_permalink(){

// retorno
return retorne_campo_formulario_request(29) != null;

};

?>