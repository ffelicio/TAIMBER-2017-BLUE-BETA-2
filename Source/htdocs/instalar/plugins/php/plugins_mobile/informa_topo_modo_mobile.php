<?php

// informa no topo que está usando o modo mobile
function informa_topo_modo_mobile(){

// globals
global $idioma_sistema;

// valida usuario logado e se está no modo mobile
if(retorne_usuario_logado() == false and retorne_modo_mobile() == true){
	
	// imagem de sistema
	$imagem_sistema[0] = retorne_imagem_sistema(109, null, false);
	
	// html
	$html = "
	<div class='classe_informa_modo_mobile_topo classe_cor_11 borda_div_3'>
	
	<div class='classe_informa_modo_mobile_topo_imagem'>
	$imagem_sistema[0] 
	</div>
	
	<div class='classe_informa_modo_mobile_topo_imagem_texto classe_cor_15'>
	$idioma_sistema[586]
	</div>
	
	</div>
	
	";

};

// retorno
return $html;

};

?>