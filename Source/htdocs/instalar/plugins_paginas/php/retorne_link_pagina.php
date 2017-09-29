<?php

// retorna o link da pagina
function retorne_link_pagina($id, $titulo, $conteudo){

// globals
global $variavel_campo;

// valida se um nome foi definido
if(retorne_somente_nome_amigavel_idusuario(null, 1, $id) == null){
	
	// url de pagina inicial
	$url_pagina = PAGINA_INICIAL."?$variavel_campo[25]=$id";
	
}else{
	
	// url de pagina
	$url_pagina = retorne_url_amigavel_usuario(null, 1, $id);

};

// html
$html = "
<a href='$url_pagina' title='$titulo'>$conteudo</a>
";

// retorno
return $html;

};

?>