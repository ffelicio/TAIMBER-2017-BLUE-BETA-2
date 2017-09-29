<?php

// eventos mover mosue sobre a pagina
function eventos_mover_mouse_pagina(){

# NÃO USE REQUISIÇÕES COM O SERVIDOR POR AQUI
# CASO CONTRARIO VAI CAUSAR LENTIDÃO!!!

// valida usuario logado
if(retorne_usuario_logado() == false){

	// retorno nulo
	return null;

};

// eventos
$evento[0] = "atualiza_modo_deslogar(event);";

// html
$html = "
<script language='javascript'>

// evento
$(document).mousemove(function(event){
    
	$evento[0]
	
});

</script>
";

// retorno
return $html;

};

?>