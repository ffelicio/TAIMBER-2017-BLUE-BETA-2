<?php

// constroe o campo de notificao
function constroe_campo_notifica(){

// globals
global $idioma_sistema;
global $url_link_acao;

// valida numero de notificoes ou se o modulo esta habilitado
if(retorne_usuario_logado() == false or HABILITAR_MODO_NOTIFICA == false){
	
	// retorno nulo
    return null;
	
};

// modo mobile
$modo_mobile = retorne_modo_mobile();

// id de usuario logado
$uid = retorne_idusuario_logado();

// modo plano de fundo
$modo_plano_fundo = retorne_modo_plano_fundo();
	
// valida modo mobile
if($modo_mobile == true){
	
	// imagens
	$imagem[8] = retorne_imagem_sistema(87, null, false);

}else{
	
	// valida modo plano de fundo
	if($modo_plano_fundo == true){

		// imagens
		$imagem[8] = retorne_imagem_sistema(51, null, false);
		
	}else{
		
		// imagens
		$imagem[8] = retorne_imagem_sistema(77, null, false);

	};
	
};

// id de campos
$idcampo[1] = codifica_md5("id_campo_notifica_curtidas_".data_atual());
$idcampo[2] = codifica_md5("id_campo_notifica_comentarios_".data_atual());
$idcampo[3] = codifica_md5("id_campo_notifica_mensagens_".data_atual());
$idcampo[4] = codifica_md5("id_campo_numero_notificacoes_gerais_".data_atual());
$idcampo[5] = codifica_md5("id_campo_notifica_depoimentos_".data_atual());
$idcampo[6] = codifica_md5("id_campo_notifica_amizades_".data_atual());
$idcampo[7] = codifica_md5("id_campo_notifica_marcacoes_".data_atual());
$idcampo[8] = codifica_md5("id_campo_notifica_amizades_aceitas_".data_atual());
$idcampo[9] = codifica_md5("id_campo_notifica_mensagens_usuario_topo_".data_atual());

// campos de timer
$campo_timer[0] = "
atualiza_notifica_timer(\"$idcampo[4]\", \"$idcampo[2]\", \"$idcampo[1]\", \"$idcampo[3]\", \"$idcampo[5]\", \"$idcampo[6]\", \"$idcampo[7]\", \"$idcampo[8]\", \"$idcampo[9]\");
";

// scripts
$script[0] = "
<script>
$campo_timer[0]
</script>
";

// adiciona o timer
$campo_timer[0] = plugin_timer_sistema(2, $campo_timer[0]);

// links
$links[1] = "<a href='$url_link_acao[14]' title='$idioma_sistema[78]'></a>";
$links[2] = "<a href='$url_link_acao[15]' title='$idioma_sistema[279]'></a>";
$links[3] = "<a href='$url_link_acao[16]' title='$idioma_sistema[220]'></a>";
$links[4] = "<a href='$url_link_acao[17]' title='$idioma_sistema[180]'></a>";
$links[5] = "<a href='$url_link_acao[18]' title='$idioma_sistema[109]'></a>";
$links[6] = "<a href='$url_link_acao[19]' title='$idioma_sistema[293]'></a>";
$links[7] = "<a href='$url_link_acao[25]' title='$idioma_sistema[423]'></a>";
$links[8] = "<a href='$url_link_acao[30]' title='$idioma_sistema[220]'>$imagem[8]</a>";

// campo de notificao de relacionamento
$campo_relacionamento = constroe_campo_notifica_relacionamento();

// campos
$campo[0] = "

<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[1]'>
		$links[1]
	</span>
</div>

<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[2]'>
		$links[2]
	</span>
</div>

<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[3]'>
		$links[3]
	</span>
</div>

<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[5]'>
		$links[4]
	</span>
</div>

<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[6]'>
		$links[5]
	</span>
</div>

<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[7]'>
		$links[6]
	</span>
</div>

<div class='classe_div_opcao_menu_suspense'>
	<span class='classe_span_opcao_notifica' id='$idcampo[8]'>
		$links[7]
	</span>
</div>

$campo_relacionamento

";

// valida modo plano de fundo
if($modo_plano_fundo == true){

	// adiciona dialogo
	$campo[0] = constroe_menu_suspense(false, null, true, 50, null, $campo[0]);
	
}else{
	
	// adiciona dialogo
	$campo[0] = constroe_menu_suspense(false, null, true, 23, null, $campo[0]);

};

// valida sexo de usuario
if(retorne_sexo_usuario_logado() == 1){
	
	// classe
	$classe[0] = "classe_campo_notifica_numero";

}else{
	
	// classe
	$classe[0] = "classe_campo_notifica_numero_2";
	
};

// campo notifica
$campo_notifica[0] = "
<div class='classe_campo_notifica'>

	<div class='classe_campo_notifica_imagem'>
		$campo[0]
	</div>

	<span class='$classe[0]' id='$idcampo[4]'></span>

</div>
";

// campo notifica
$campo_notifica[1] = "
<div class='classe_campo_notifica'>

	<div class='classe_campo_notifica_imagem'>
		$links[8]
	</div>

	<span class='$classe[0]' id='$idcampo[9]'></span>

</div>
";

// html
$html = "
$campo_notifica[0]
$campo_notifica[1]

$campo_timer[0]
$script[0]

";

// retorno
return $html;

};

?>