<?php

// constroe campo info link
function constroe_campo_info_link($modo, $uid){

# modo de retorno 0 retorna o evento ja o modo 1 retorna os campos

// modo 0 informacoes de perfil
// modo 1 informacoes da pagina

// globals
global $idioma_sistema;

// id de campo
$idcampo[0] = codifica_md5("id_menu_suspense_campo_info_link_".retorne_contador_iteracao());
$idcampo[1] = codifica_md5("id_informacoes_campo_info_link_".retorne_contador_iteracao());

// nome de funcoes
$nome_funcao[0] = "a_".codifica_md5("funcao_nome_".retorne_contador_iteracao());
$nome_funcao[1] = "b_".codifica_md5("funcao_nome_".retorne_contador_iteracao());
$nome_funcao[2] = "c_".codifica_md5("funcao_nome_".retorne_contador_iteracao());
$nome_funcao[3] = "d_".codifica_md5("funcao_nome_".retorne_contador_iteracao());

// nome de variavel
$nome_variavel[0] = "d_".codifica_md5("nome_variavel_".retorne_contador_iteracao());
$nome_variavel[1] = "e_".codifica_md5("nome_variavel_".retorne_contador_iteracao());

// funcoes
$funcao[0] = "exibe_info_link(\"$modo\", \"$uid\", \"$idcampo[0]\", \"$idcampo[1]\", $nome_variavel[1])";
$funcao[1] = "fechar_menu_suspense(\"$idcampo[0]\");";
$funcao[2] = "$nome_funcao[0](this, 0)";
$funcao[3] = "$nome_funcao[0](this, 1)";

// eventos
$evento[0] = "onmousemove='$funcao[2]'";
$evento[1] = "onmouseout='$funcao[3]'";

// campos
$campo[0] = "
<div class='classe_informacoes_info_link' id='$idcampo[1]'>
$idioma_sistema[210]
</div>
";

// tempo de timer
$tempo = TEMPO_TIMER_INFO_LINK;

// html
$html .= constroe_dialogo_acao($idioma_sistema[403], $campo[0], $idcampo[0]);
$html .= $timer[0];
$html .= "
<script language='javascript'>

var $nome_variavel[0] = null;
var $nome_variavel[1] = null;


function $nome_funcao[1](){

$funcao[0]
	
};


function $nome_funcao[2](element){
	
$nome_variavel[1] = element;
	
};


function $nome_funcao[3](){
	
$funcao[1]	
	
};




// timer info link
function $nome_funcao[0](element, modo){

// valida o modo do timer
switch(modo){
	
	case 0:
	clearTimeout($nome_variavel[0]);
	$nome_funcao[2](element);
	$nome_variavel[0] = setTimeout($nome_funcao[1], $tempo);
	break;
	
	case 1:
	clearTimeout($nome_variavel[0]);
	$nome_funcao[2](element);
	$nome_variavel[0] = setTimeout($nome_funcao[3], $tempo);
	break;

};

};

</script>
";

// array de retorno
$array_retorno[0] = $evento[0]." ".$evento[1];
$array_retorno[1] = $html;

// retorno
return $array_retorno;

};

?>