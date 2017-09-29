<?php

// formulario de login
function plugin_formulario_login(){

// globals
global $idioma_sistema;
global $variavel_campo;

// modo mobile
$modo_mobile = retorne_modo_mobile();

// valida modo mobile
if(retorne_usuario_logado() == true){
	
	// retorno nulo
	return null;
	
};

// campos
$campo[0] = constroe_campo_recupera_senha(false);

// id de campo
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();
$idcampo[4] = retorne_idcampo_md5();
$idcampo[5] = retorne_idcampo_md5();
$idcampo[6] = retorne_idcampo_md5();

// barra de progresso
$progresso[0] = campo_progresso_gif($idcampo[0]);

// funcoes
$funcao[0] = "logar_usuario(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[3]\", \"$idcampo[4]\", \"$idcampo[5]\", \"$idcampo[6]\");";

// eventos
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";

// campos
$campo[1] = "
<span id='$idcampo[4]' class='botao_padrao' $evento[0]>$idioma_sistema[3]</span>
";

// valida o modo mobile
if($modo_mobile == false){
	
	// campos
	$campo[2] = "
	<div class='classe_formulario_login_titulo'>
	$idioma_sistema[472]
	</div>
	";

	// placeholders
	$placeholder[0] = "placeholder='$idioma_sistema[1]'";
	$placeholder[1] = "placeholder='$idioma_sistema[2]'";
	
}else{
	
	// textos
	$texto[0] = "<span class='span_descreve_formulario_login'>$idioma_sistema[492]</span>";
	$texto[1] = "<span class='span_descreve_formulario_login'>$idioma_sistema[493]</span>";
	
};

// campos
$campo[3] = "
<div class='classe_formulario_login_div_mensagem' id='$idcampo[3]'></div>
";

// adiciona dialogo
$campo[3] = constroe_dialogo($idioma_sistema[595], $campo[3], $idcampo[6]);

// html
$html = "
<div class='classe_formulario_login' id='$idcampo[5]'>

$campo[2]

$texto[0]
<div class='classe_formulario_login_div'>
<input type='email' id='$idcampo[1]' $placeholder[0] $evento[1] required>
</div>

$texto[1]
<div class='classe_formulario_login_div'>
<input type='password' id='$idcampo[2]' $placeholder[1] $evento[1] required>
</div>

<div class='classe_formulario_login_botao'>
$campo[1]
$progresso[0]
</div>

$campo[0]

</div>


$campo[3]
";

// retorno
return $html;

};

?>