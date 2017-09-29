<?php

// constroe as opcoes de configuracoes
function constroe_opcoes_configuracoes($modo){

// globals
global $url_link_acao;

// valida modo
switch($modo){
	
	case 1:
	$url_atual = $url_link_acao[6];
	break;
	
	case 2:
	$url_atual = $url_link_acao[7];
	break;
	
	case 3:
	$url_atual = $url_link_acao[8];
	break;
	
	case 4:
	$url_atual = $url_link_acao[9];
	break;
	
	case 5:
	$url_atual = $url_link_acao[10];
	break;
	
	case 6:
	$url_atual = $url_link_acao[11];
	break;
	
	case 7:
	$url_atual = $url_link_acao[12];
	break;
	
	case 8:
	$url_atual = $url_link_acao[23];
	break;
	
	case 9:
	$url_atual = $url_link_acao[26];
	break;
	
	default:
	$url_atual = $url_link_acao[6];
	
};

// opcoes disponiveis
$opcoes_disponiveis[] = $url_link_acao[6];
$opcoes_disponiveis[] = $url_link_acao[7];
$opcoes_disponiveis[] = $url_link_acao[8];
$opcoes_disponiveis[] = $url_link_acao[9];
$opcoes_disponiveis[] = $url_link_acao[10];
$opcoes_disponiveis[] = $url_link_acao[11];
$opcoes_disponiveis[] = $url_link_acao[12];
$opcoes_disponiveis[] = $url_link_acao[23];
$opcoes_disponiveis[] = $url_link_acao[26];

// constroe links com opcoes de configuracoes
foreach($opcoes_disponiveis as $url){
	
	// valida url atual
	if($url == $url_atual){
		
		// codigo  html
		$html .= "
		<div class='classe_div_opcao_configuracao_selecionada classe_cor_3'>$url</div>
		";
		
	}else{
		
		// html
		$html .= "
		<div class='classe_div_opcao_configuracao_padrao'>$url</div>
		";
		
	};

};

// retorno
return $html;

};

?>