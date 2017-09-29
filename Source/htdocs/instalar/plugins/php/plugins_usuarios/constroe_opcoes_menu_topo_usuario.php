<?php

// constroe as opcoes de topo em formato menu
function constroe_opcoes_menu_topo_usuario(){

// globals
global $url_link_acao;

// valida usuario logado
if(retorne_usuario_logado() == false){

    // retorno nulo
    return null;	
	
};

// modo mobile
$modo_mobile = retorne_modo_mobile();

// modo plano de fundo
$modo_plano_fundo = retorne_modo_plano_fundo();

// links
$link[0] = retorna_links(3, null);

// campo de menu
$campo_menu[0] = "
<div class='classe_div_opcao_menu_suspense'>$url_link_acao[0]</div>
";

// valida url de link
if($url_link_acao[1] != null){

    // campo de menu
    $campo_menu[1] = "
	<div class='classe_div_opcao_menu_suspense'>$url_link_acao[1]</div>
    ";	
	
};

// campo de menu
$campo_menu[2] = "
<div class='classe_div_opcao_menu_suspense'>$link[0]</div>
";

// campo de menu
$campo_menu[3] = "
<div class='classe_div_opcao_menu_suspense'>$url_link_acao[5]</div>
";

// campo de menu
$campo_menu[4] = "
<div class='classe_div_opcao_menu_suspense'>$url_link_acao[28]</div>
";

// campos
$campo_menu[5] = opcao_mobile_menu_topo();

// corpo do menu em suspense
$corpo_menu_suspense = "
$campo_menu[4]
$campo_menu[0]
$campo_menu[1]
$campo_menu[3]
$campo_menu[5]
$campo_menu[2]
";

// valida modo plano de fundo
if($modo_plano_fundo == true){
	
	// menu de suspense
	$menu_suspense[0] = constroe_menu_suspense(false, null, false, 52, "menu_suspense_opcoes_topo", $corpo_menu_suspense);
	
}else{
	
	// menu de suspense
	$menu_suspense[0] = constroe_menu_suspense(false, null, false, null, "menu_suspense_opcoes_topo", $corpo_menu_suspense);

};

// valida modo mobile
if($modo_mobile == false){
	
	$imagem_usuario = constroe_imagem_perfil_miniatura_topo(retorne_idusuario_logado());
	
	// campos
	$campo[0] = "
	$imagem_usuario
	";
	
};

// html
$html = "

<div class='classe_div_opcoes_topo'>
$menu_suspense[0]
</div>

<div class='classe_div_opcoes_topo_imagem_usuario'>
$campo[0]
</div>

";

// retorno
return $html;

};

?>