<?php

// plugin monta pagina
function plugin_monta_pagina($conteudo_parametro){

// globals
global $idioma_sistema;
global $arquivo_sistema_host;

// modo mobile
$modo_mobile = retorne_modo_mobile();

// usuario  logado
$usuario_logado = retorne_usuario_logado();

// modo plano de fundo
$modo_plano_fundo = retorne_modo_plano_fundo();

// modo permalink
$modo_permalink = retorne_modo_permalink();

// tipo de acao
$tipo_acao = retorne_tipo_acao_pagina();

// informa se está usando capa ou não
$usa_capa = retorne_usa_capa();

// valida usuario logado
if($usuario_logado == false){
	
	// loga usuario e retorna usuario logado
	$usuario_logado = logar_usuario($_COOKIE[COOKIE_EMAIL], $_COOKIE[COOKIE_SENHA], false);
	
};

// modo pagina
$modo_pagina = retorne_modo_pagina();

// arquivo de dependencia
$arquivo_dependencia[0] = $arquivo_sistema_host["css"];
$arquivo_dependencia[1] = $arquivo_sistema_host["js"];
$arquivo_dependencia[2] = $arquivo_sistema_host["jquery"];
$arquivo_dependencia[3] = $arquivo_sistema_host["jquery_form"];
$arquivo_dependencia[4] = $arquivo_sistema_host["css_efeitos"];
$arquivo_dependencia[5] = $arquivo_sistema_host["paginas_css"];
$arquivo_dependencia[6] = $arquivo_sistema_host["paginas_js"];
$arquivo_dependencia[9] = $arquivo_sistema_host["tema_resolucao"];
$arquivo_dependencia[10] = $arquivo_sistema_host["tema_deslogado"];
$arquivo_dependencia[11] = $arquivo_sistema_host["tema_feminino"];
$arquivo_dependencia[12] = $arquivo_sistema_host["tema_plano_fundo"];

// dependencias css
$dependencia_css[0] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[0]\">";
$dependencia_css[1] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[4]\">";
$dependencia_css[2] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[5]\">";
$dependencia_css[4] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[9]\">";
$dependencia_css[5] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[10]\">";
$dependencia_css[6] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[11]\">";
$dependencia_css[7] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$arquivo_dependencia[12]\">";

// dependencias javascript
$dependencia_javascript[0] = "<script src=\"$arquivo_dependencia[2]\"></script>";
$dependencia_javascript[1] = "<script src=\"$arquivo_dependencia[1]\"></script>";
$dependencia_javascript[2] = "<script src=\"$arquivo_dependencia[3]\"></script>";
$dependencia_javascript[3] = "<script src=\"$arquivo_dependencia[6]\"></script>";

// meta tags
$meta_tag = "
<meta name='description' content='$idioma_sistema[308]'>
<meta name='keywords' content='$idioma_sistema[525]'>
";

// valida modo plano de fundo
if($modo_plano_fundo == false or $usuario_logado == false){

	// limpa dependencias
	$dependencia_css[7] = null;
	
};

// subclasses
$sub_classe[1] = "borda_div_5";
$sub_classe[3] = "classe_cor_8";
$sub_classe[4] = "fundo_transparente";

// valida o permalink
if($modo_permalink == true){
	
	// subclasses
	$sub_classe[2] = "fundo_transparente";
	
};

// valida o tipo de acao
if(($tipo_acao != 9 and $tipo_acao != 22 and $modo_permalink == false and retorne_modo_hashtag() == false)){
	
	// subclasse
	$sub_classe[2] = "borda_div_5";

};

// conteudo de pagina
$conteudo_pagina = plugin_conteudo_pagina();

// valida se o conteúdo da página é um array
if(is_array($conteudo_pagina) == false){
	
	// setando o conteúdo de parâmetro
	$conteudo_parametro = $conteudo_pagina;
	
	// limpa o conteúdo de página
	$conteudo_pagina = null;
	
	// classe de parâmetro
	$classe_parametro[0] = "classe_cor_32";
	$classe_parametro[1] = "classe_div_principal_conteudo_parametro";
	
};

// conteudo de topo de pagina
$conteudo_topo_pagina = constroe_topo_pagina();

// valida está usando capa
if($usa_capa == false or $conteudo_pagina[7] == null){
	
	// classe de reposição
	$classe_posicao[0] = "posicao_top";
	
};

// valida sexo de usuario do perfil atual
if(retorne_sexo_usuario_logado() == 1){

	// limpa tema feminino
	$dependencia_css[6] = null;

};
	
// valida usuario logado
if($usuario_logado == true or $modo_mobile == true){
	
	// limpa o tema deslogado
	$dependencia_css[5] = null;
	
};

// valida modo pagina e usuario logado
if($modo_pagina == true and $usuario_logado == false){
	
	// classes de corpo
	$classe_corpo[0] = "classe_div_principal_pagina_deslogada";
	
}else{
	
	// valida a classe de parâmetro
	if($classe_parametro[1] == null){
		
		// classes de corpo
		$classe_corpo[0] = "classe_div_principal";	
		
	}else{
		
		// classes de corpo
		$classe_corpo[0] = $classe_parametro[1];
		
	};
	
};

// valida modo pagina e indica a classe apropriada
if($modo_pagina == true or $usuario_logado == false){

	// classes
	$classe[0] = "classe_div_conteudo_4 $classe_posicao[0]";
	$classe[1] = "classe_div_conteudo_6 $sub_classe[2]";
	$classe[2] = "classe_div_conteudo_5 $sub_classe[4]";
	
	// campos
	$campo[3] = "
	
	<div class='$classe[0]'>
	$conteudo_pagina[1]
	</div>	
	
	";
	
	// campos
	$campo[1] = "
	
	<div class='$classe[2]'>
	$conteudo_pagina[3]
	</div>
	
	<div class='$classe[1]'>
	$conteudo_pagina[2]
	</div>	
	
	";
	
}else{
	
	// classes
	$classe[0] = "classe_div_conteudo_1 $sub_classe[1]";
	$classe[1] = "classe_div_conteudo_2 $sub_classe[2]";
	$classe[2] = "classe_div_conteudo_3 $classe_posicao[0]";
	$classe[4] = "classe_div_conteudo_7 $sub_classe[3]";
	
	// campos
	$campo[3] = "
	
	<div class='$classe[2]'>
	$conteudo_pagina[3]
	</div>	
	
	";
	
	// valida conteudo de campo
	if($conteudo_pagina[6] != null){
		
		// campos
		$campo[6] = "
		
		<div class='$classe[4]'>
		$conteudo_pagina[6]
		</div>
	
		";
	
	};
	
	// campos
	$campo[1] = "
	
	<div class='$classe[0]'>
	$conteudo_pagina[1]
	</div>
	
	$campo[6]
	
	<div class='$classe[1]'>
	$conteudo_pagina[2]
	</div>

	";
	
};

// valida conteudo de parametro
if($conteudo_parametro != null){

	// conteudo de parametro
	$conteudo_parametro = "
	<div class='classe_conteudo_parametro_centro $classe_parametro[0]'>
	$conteudo_parametro
	</div>
	";
	
	// seta novo conteudo
	$campo = null;
	
	// campos
	$campo[1] = $conteudo_parametro;
	
};

// valida rodape
if($conteudo_pagina[4] != null and $usuario_logado == false){
	
	// campo de rodape
	$campo[2] = "
	
	<div class='classe_div_rodape classe_cor_29'>
	$conteudo_pagina[4]
	</div>
	
	";

};

// campos
$campo[4] = $conteudo_pagina[5];

// valida parametro
if($conteudo_parametro != null){
	
	// campos
	$campo[1] = $conteudo_parametro;
	$campo[4] = null;

	// limpa campos
	$conteudo_pagina[7] = null;
	
};

// valida conteudo de pagina é um array
if(is_array($conteudo_pagina) == false){
	
	// atualiza campos...
	$campo[4] = null;
	$campo[3] = null;
	$campo[2] = null;
	$campo[1] = $conteudo_pagina;

	// classes
	$classe[3] = "classe_div_centro_pagina_raiz_completa";
	$classe_corpo[0] = "classe_div_principal_completa";
	
}else{
	
	// classes
	$classe[3] = "classe_div_centro_pagina_raiz";	
	
};

// informa no topo que está usando o modo mobile
$campo[5] = informa_topo_modo_mobile();

// topo da pagina
$topo_pagina = "
<div class='classe_div_topo classe_cor_1'>
$conteudo_topo_pagina
</div>
";

// valida se a capa foi informada
if($conteudo_pagina[7] != null and $tipo_acao != 98){
	
	// campo de capa
	$campo[7] = $conteudo_pagina[7];
	
	// campo de capa
	$campo[7] = "
	<div class='classe_div_conteudo_8'>
		$campo[7]
	</div>
	";
	
};

// corpo da pagina
$corpo_pagina = "

$topo_pagina
$campo[5]
$informa_topo_modo_mobile
$campo[4]

<div class='$classe[3]'>
	
	$campo[7]
	
	<div class='$classe_corpo[0]'>
		$campo[1]
	</div>

	$campo[3]

</div>

$campo[2]

";

// variaveis javascript
$variaveis_javascript = plugins_variaveis_javascript();

// paginadores
$paginadores_javascript = constroe_paginadores_javascript();

// titulo da pagina
$titulo_pagina = retorne_titulo_pagina();

// carrega funcoes especificas atraves de um timer
$funcoes_timer = plugin_funcoes_timer_pagina();

// iniciar ao terminar o carregamento da pagina
$iniciar_apos_carregamento = iniciar_apos_carregamento();

// funcoes mover mouse sobre pagina
$funcoes_mover_mouse_pagina = eventos_mover_mouse_pagina();

// valida modo mobile
if($modo_mobile == true){
	
	// metas do site
	$metas_site[0] = "<meta name='viewport' content='width=device-width'/>";

}else{
	
	// limpa o tema de css
	$dependencia_css[4] = null;
	
};

// plano de fundo de head
$plano_fundo_head = constroe_plano_fundo_usuario();

// codigo htl
$html = "

<!DOCTYPE html>


<!-- documento html -->
<html>
\n
<head>
\n


<!-- plano de fundo -->
\n
$plano_fundo_head
\n
<!-- fim de plano de fundo -->


<!-- dependencia css -->
$dependencia_css[0]
\n
$dependencia_css[1]
\n
$dependencia_css[2]
\n
$dependencia_css[5]
\n
$dependencia_css[4]
\n
$dependencia_css[6]
\n
$dependencia_css[7]
\n
<!-- fim de css -->


<!-- titulo da pagina -->
<title>$titulo_pagina</title>
\n
<!-- fim de titulo -->


<!-- metas do site -->
$metas_site[0]
\n
<!-- fim de metas do site -->


<!-- meta tags -->
$meta_tag
<!-- fim de meta tags -->


<!-- jquery -->
$dependencia_javascript[0]
\n
<!-- fim de jquery -->


<!-- jquery de formulario -->
$dependencia_javascript[2]
\n
<!-- fim de formulario -->


<!-- dependencia javascript -->
$dependencia_javascript[1]
\n
$dependencia_javascript[3]
\n
<!-- fim de dependencia javascript -->


<!-- variaveis javascript -->
$variaveis_javascript
\n
<!-- fim de variaveis javascript -->


<!-- paginadores javascript -->
\n
$paginadores_javascript
\n
<!-- fim de paginadores javascript -->


<!-- funcoes de timer -->
\n
$funcoes_timer
\n
<!-- fim de funcoes de timer -->


</head>
\n


<!-- inicio do corpo da pagina -->
<body>
\n
$corpo_pagina
\n
</body>
<!-- fim do corpo da pagina -->
\n


<!-- funcoes pos carregamento -->
$iniciar_apos_carregamento
\n
<!-- fim de pos carregamento -->


<!-- funcoes mover mouse sobre a pagina -->
$funcoes_mover_mouse_pagina
\n
<!--  fim de mover mouse sobre a pagina -->


</html>
<!-- fim de pagiana html -->


";

// retorno
return remove_linhas_branco($html);

};

?>