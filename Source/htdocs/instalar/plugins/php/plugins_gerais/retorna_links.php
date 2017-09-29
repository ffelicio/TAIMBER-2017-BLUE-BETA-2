<?php

// retorna links
function retorna_links($modo, $titulo){

// globals
global $variavel_campo;
global $idioma_sistema;

// id de usuario
$uid = retorne_idusuario_request();

// valida o modo
switch($modo){
	
	case 3: // visualizar perfil
	$titulo = $idioma_sistema[17];
	break;

};

// link
$link = PAGINA_INDEX_INICIO."?$variavel_campo[5]=$uid&$variavel_campo[2]=$modo";
$link = "<a href='$link' title='$titulo'>$titulo</a>";

// retorno
return $link;

};

?>