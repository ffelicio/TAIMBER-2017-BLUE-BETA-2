<?php

// conteudo de topo de meio de pagina
function constroe_conteudo_topo_meio(){

// globals
global $idioma_sistema;

// id de usuario
$uid = retorne_idusuario_request();

// id de campos
$idcampo[0] = codifica_md5("id_campo_visualiza_ultima_visualizacao_".retorne_contador_iteracao());

// funcoes
$funcao[0] = "executador_acao(null, 85, \"$idcampo[0]\")";

// timer
$timer[0] = plugin_timer_sistema(2, $funcao[0]);

// usuario online
$online = retorne_data_ultima_visualizacao_conexao($uid, false);

// campos
$campo[0] = "
<div class='classe_visualizado_pagina_topo_meio classe_cor_7' id='$idcampo[0]'>
$online
</div>
";

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// limpa o timer
	$timer[0] = null;

};

// html
$html = "
<div class='classe_conteudo_topo_meio'>
$campo[0]
</div>

$timer[0]
";

// retorno
return $html;

};

?>