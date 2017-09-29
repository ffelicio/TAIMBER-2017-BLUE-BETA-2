<?php

// retorna o modo plano de fundo
function retorne_modo_plano_fundo(){

// valida modo pagina
if(retorne_modo_pagina() == true or retorne_modo_mobile() == true){
	
	// retorno falso
	return false;
	
};

// dados de plano de fundo
$dados = retorne_dados_plano_fundo();

// separando dados
$url_host_grande = $dados[URL_HOST_GRANDE];

// valida url de host grande
if($url_host_grande != null){
	
	// modo plano de fundo
	return true;
	
}else{
	
	// modo não plano de fundo
	return false;
	
};

};

?>