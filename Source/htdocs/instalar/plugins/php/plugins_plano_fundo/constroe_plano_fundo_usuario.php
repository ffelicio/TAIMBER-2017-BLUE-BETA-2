<?php

// constroe plano de fundo de usuario
function constroe_plano_fundo_usuario(){

// valida modo pagina
if(retorne_modo_pagina() == true or retorne_modo_mobile() == true){
	
	// retorno nulo
	return null;
	
};

// dados de plano de fundo
$dados = retorne_dados_plano_fundo();

// separando dados
$url_host_grande = $dados[URL_HOST_GRANDE];

// valida host grande
if($url_host_grande == null){
	
	// retorno nulo
	return null;
	
};

// html
$html = "
<style type='text/css'>

body{
	
	background-image: url('$url_host_grande');

}

</style>
";

// retorno
return $html;

};

?>