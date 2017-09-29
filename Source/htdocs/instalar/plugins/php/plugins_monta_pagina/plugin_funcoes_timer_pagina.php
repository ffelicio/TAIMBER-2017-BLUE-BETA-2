<?php

// carrega funcoes especificas atraves de um timer
function plugin_funcoes_timer_pagina(){

// campo de conexao, funcoes javascript
$campo_conexao = "
executador_acao(null, 45, null);
executador_acao(null, 83, null);
";

// valida usuario logado
if(retorne_usuario_logado() == true){
	
    // adiciona o timer
    $campo_conexao = plugin_timer_sistema(1, $campo_conexao);

}else{
	
	// limpa funcoes javascript
	$campo_conexao = null;
	
};

// html
$html = "
$campo_conexao
";

// retorno
return $html;

};

?>