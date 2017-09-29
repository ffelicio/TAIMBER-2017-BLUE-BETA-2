<?php

// retorna o estado da noticia do usuario
function retorne_estado_noticia_usuario(){

// globals
global $url_feed_estado;

// retorno
return $url_feed_estado[retorne_numero_estado_usuario_logado()];

};

?>