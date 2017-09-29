<?php

// constroe o conteudo deslogado
function constroe_conteudo_deslogado(){

// globals
global $idioma_sistema;

// tipo de acao
$tipo_acao = retorne_campo_formulario_request(2);

// valida o tipo de acao
switch($tipo_acao){

	case 102:
	$conteudo = constroe_recuperar_alterar_senha();
	break;

	case 112:
	$conteudo = formulario_cadastro(false);
	break;
	
	case 113:
	$conteudo = constroe_campo_recupera_senha(true);
	break;
	
	default:
	$conteudo = plugin_formulario_login();
	
};

// campo para alterar o idioma
$campo_idioma = constroe_alterar_idioma();

// conteudo
$conteudo = "
<div class='classe_conteudo_padrao_deslogado cor_borda_div_4'>
	$conteudo
	$campo_idioma
</div>
";

// retorno
return $conteudo;

};

?>