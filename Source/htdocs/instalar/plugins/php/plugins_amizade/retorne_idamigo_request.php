<?php

// retorna o id de amigo de request
function retorne_idamigo_request(){

// globals
global $variavel_campo;

// id de usuario via requeste
return remove_html($_REQUEST[$variavel_campo[13]]);

};

?>