<?php

// constroe conteudo de subtopo
function constroe_conteudo_sub_topo(){

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// retorno nulo
	return null;
	
};

// campos
$campo[0] = constroe_campo_mensagem_ativar_usuario();

// valida campo mensagem ativar usuario
if($campo[0] == null){
	
	// retorno nulo
	return null;
	
};

// html
$html = "
<div class='classe_campo_subtopo classe_cor_23 classe_cor_8'>
$campo[0]
</div>
";

// retorno
return $html;

};

?>