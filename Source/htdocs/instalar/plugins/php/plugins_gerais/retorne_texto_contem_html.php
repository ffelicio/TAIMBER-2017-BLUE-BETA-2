<?php

// retorna se um texto contem html
function retorne_texto_contem_html($texto){

// retorno
return $texto != strip_tags($texto);

};

?>