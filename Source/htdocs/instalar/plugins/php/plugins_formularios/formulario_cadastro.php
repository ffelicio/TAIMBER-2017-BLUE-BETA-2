<?php

// formulario de cadastro
function formulario_cadastro($modo){

// modo true exibe apenas o link para o formulario de cadastro
// modo false exibe o formulario de cadastro

// globals
global $idioma_sistema;
global $url_link_acao;

// valida o modo
if($modo == true){

	// id de campos
	$idcampo[0] = retorne_id_formulario_cadastro();
	
	// pagina inicial
	$pagina_inicial = PAGINA_INICIAL;
	
	// links
	$link[0] = $url_link_acao[31];
	
	// html
	$html = "
	<div class='classe_formulario_cadastro_link_cadastro' id='$idcampo[0]'>
	$link[0]
	</div>
	";
	
	// retorno
	return $html;

};

// modo mobile
$modo_mobile = retorne_modo_mobile();

// id de campos
$idcampo[0] = codifica_md5("id_campo_cadastro_nome");
$idcampo[1] = codifica_md5("id_campo_cadastro_sobrenome");
$idcampo[2] = codifica_md5("id_campo_cadastro_email");
$idcampo[3] = codifica_md5("id_campo_cadastro_senha");
$idcampo[4] = codifica_md5("id_campo_cadastro_senha_confirma");
$idcampo[5] = codifica_md5("id_campo_cadastro_mensagem_sucesso");
$idcampo[6] = codifica_md5("id_campo_cadastro_botao");
$idcampo[7] = codifica_md5("id_campo_cadastro_progresso");
$idcampo[8] = retorne_id_formulario_cadastro();

// campo de progresso
$campo_progresso[0] = campo_progresso_gif($idcampo[7]);

// funcoes
$funcao[0] = "cadastrar_usuario(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[3]\", \"$idcampo[4]\", \"$idcampo[5]\", \"$idcampo[6]\", \"$idcampo[7]\");";

// eventos
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";

// classe
$classe[0] = "classe_formulario_cadastro_topo";

// html
$html = "
<div class='classe_formulario_cadastro' id='$idcampo[8]'>

<div class='$classe[0]'>

<div class='classe_formulario_cadastro_titulo'>
$idioma_sistema[577]
</div>

</div>

<div class='classe_formulario_cadastro_campo'>
<input type='text' id='$idcampo[0]' placeholder='$idioma_sistema[299]' $evento[1] required>
</div>

<div class='classe_formulario_cadastro_campo'>
<input type='text' id='$idcampo[1]' placeholder='$idioma_sistema[300]' $evento[1] required>
</div>

<div class='classe_formulario_cadastro_campo'>
<input type='email' id='$idcampo[2]' placeholder='$idioma_sistema[1]' $evento[1] required>
</div>

<div class='classe_formulario_cadastro_campo'>
<input type='password' id='$idcampo[3]' placeholder='$idioma_sistema[2]' $evento[1] required>
</div>

<div class='classe_formulario_cadastro_campo'>
<input type='password' id='$idcampo[4]' placeholder='$idioma_sistema[301]' $evento[1] required>
</div>

<div class='classe_formulario_login_div_mensagem' id='$idcampo[5]'></div>

$campo_progresso[0]

<div class='classe_formulario_cadastro_campo_botao' id='$idcampo[6]'>
<span class='botao_padrao' $evento[0]>$idioma_sistema[171]</span>
</div>

<div class='classe_formulario_cadastro_campo_termo'>
$url_link_acao[27]
</div>

</div>
";

// retorno
return $html;

};

?>