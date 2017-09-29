<?php

// formulario de login de topo
function formulario_login_topo(){

// globals
global $idioma_sistema;
global $variavel_campo;

// valida modo mobile
if(retorne_modo_mobile() == true or retorne_usuario_logado() == true){
	
	// retorno nulo
	return null;
	
};

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
$campo[0] = "
<div class='classe_barra_progresso_formulario_login_topo' id='$idcampo[4]'>
$progresso[0]
</div>

<div class='classe_formulario_topo_login_botao'>
	<span class='span_link_2' $evento[0]>$idioma_sistema[3]</span>
</div>
";

// campos
$campo[1] = constroe_campo_recupera_senha(false);

// campos
$campo[2] = "
<div class='classe_formulario_topo_login_div_mensagem' id='$idcampo[3]'></div>
";

// adiciona dialogo
$campo[2] = constroe_dialogo($idioma_sistema[595], $campo[2], $idcampo[6]);

// html
$html = "
<div class='classe_formulario_topo_login' id='$idcampo[5]'>

<div class='classe_formulario_topo_login_div'>
<input type='email' id='$idcampo[1]' placeholder='$idioma_sistema[1]' $evento[1] required>
</div>

<div class='classe_formulario_topo_login_div'>
<input type='password' id='$idcampo[2]' placeholder='$idioma_sistema[2]' $evento[1] required>
</div>

$campo[0]
$campo[1]

</div>

$campo[2]
";

// retorno
return $html;

};

?>