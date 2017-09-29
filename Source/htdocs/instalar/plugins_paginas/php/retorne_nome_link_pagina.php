<?php

// retorna o nome link da pagina
function retorne_nome_link_pagina($id){

// titulo da pagina
$titulo = retorne_titulo_pagina_id($id);

// links
$link = retorne_link_pagina($id, $titulo, $titulo);

// html
$html = "
<span class='span_link classe_nome_link_pagina_span'>
$link
</span>
";

// retorno
return $html;

};

?>