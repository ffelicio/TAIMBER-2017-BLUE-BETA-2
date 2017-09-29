<?php

// constroe o conteudo de rodape
function constroe_conteudo_rodape(){

// globals
global $copyright;
global $administradores_sistema;
global $idioma_sistema;
global $url_link_acao;

// usuario logado
$usuario_logado = retorne_usuario_logado();

// nome link do fundador
$nome_link = retorne_nome_link_usuario(true, retorne_idusuario_email($administradores_sistema[0]));
	
// data completa ano
$data = date("Y");
	
// nome do sistema
$nome_sistema = NOME_SISTEMA;

// url de pagina inicial
$url_pagina_inicial = PAGINA_INICIAL;

// classes
$classe[0] = "classe_copyright_separa_principal";
$classe[1] = "classe_copyright_separa_link";
$classe[2] = "classe_copyright_separa_sub_link";

// campos
$campo[0] = "

<div class='$classe[0]'>

<div class='$classe[1]'>

<div class='$classe[2]'>
$copyright[0]
</div>

<div class='$classe[2]'>
$nome_link
</div>

</div>

</div>

";

// campos
$campo[1] = "

<div class='$classe[0]'>

<div class='$classe[1]'>
$url_link_acao[28]
</div>

<div class='$classe[1]'>
$idioma_sistema[604]
</div>

<div class='$classe[1]'>
$url_link_acao[27]
</div>

</div>

";

// campos
$campo[2] = "

<div class='$classe[0]'>

<div class='$classe[1]'>
<a href='$url_pagina_inicial' title='$nome_sistema'>$nome_sistema</a> $idioma_sistema[465] $data
</div>

</div>

";

// html
$html = "
$campo[2]
$campo[1]
$campo[0]
";

// valida modo
if($modo == true and $usuario_logado == true){
	
	// html
	$html = null;
	
}else{
	
	// html
	$html = "
	<div class='classe_conteudo_rodape_deslogado'>
	$html
	</div>
	";
	
};

// retorno
return $html;

};

?>