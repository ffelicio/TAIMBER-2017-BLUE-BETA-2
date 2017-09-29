<?php

// constroe a opcao mobile de menu de topo
function opcao_mobile_menu_topo(){

// globals
global $idioma_sistema;

// valida modo mobile foi ativado
if($_SESSION[SESSAO_MODO_MOBILE_ATIVOU] == true){
	
	// retorno nulo
	return null;

};

// funcoes
$funcao[0] = "define_modo_mobile();";

// eventos
$evento[0] = "onclick='$funcao[0];'";

// valida modo mobile
if(retorne_modo_mobile() == true){
	
	// texto
	$texto = $idioma_sistema[489];
	
}else{
	
	// texto
	$texto = $idioma_sistema[488];	

};

// html
$html = "
<div class='classe_div_opcao_menu_suspense' $evento[0]>
<span class='span_link'>$texto</span>
</div>
";

// retorno
return $html;

};

?>