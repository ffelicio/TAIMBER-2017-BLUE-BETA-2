<?php

// formulario altera senha
function formulario_altera_senha(){

// globals
global $idioma_sistema;

// chave
$chave = retorna_chave_request();

// id de campos de formulario
$id_campos[0] = codifica_md5("formulario_alterar_senha_0".data_atual());
$id_campos[1] = codifica_md5("formulario_alterar_senha_2".data_atual());
$id_campos[2] = codifica_md5("formulario_alterar_senha_3".data_atual());
$id_campos[3] = codifica_md5("formulario_alterar_senha_4".data_atual());

// funcoes
$funcao[0] = "alterar_senha(\"$id_campos[0]\", \"$id_campos[1]\", \"$id_campos[2]\", \"$id_campos[3]\");";
$funcao[1] = "nova_senha(\"$chave\", \"$id_campos[0]\", \"$id_campos[2]\", \"$id_campos[3]\");";

// valida usuario logado
if(retorne_usuario_logado() == true){
	
	// eventos
	$eventos[0] = "onclick='$funcao[0]'";
	$eventos[1] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";

	// campos
	$campo[0] = "

	<div class='classe_separa_item_formulario_alterar_senha'>
	<input type='password' placeholder='$idioma_sistema[136]' id='$id_campos[1]' $eventos[1]>
	</div>	
	
	";
	
}else{
	
	// eventos
	$eventos[0] = "onclick='$funcao[1]'";
	$eventos[1] = "onkeydown='if(event.keyCode == 13){$funcao[1]}'";

};

// html
$html = "
<div class='classe_formulario_alterar_senha'>
<div class='classe_titulo_formulario_alterar_senha classe_cor_3'>$idioma_sistema[112]</div>

<div class='classe_mensagem_formulario_alterar_senha' id='$id_campos[0]'></div>

$campo[0]

<div class='classe_separa_item_formulario_alterar_senha'>
<input type='password' placeholder='$idioma_sistema[137]' id='$id_campos[2]' $eventos[1]>
</div>

<div class='classe_separa_item_formulario_alterar_senha'>
<input type='password' placeholder='$idioma_sistema[138]' id='$id_campos[3]' $eventos[1]>
</div>

<div class='classe_separa_item_formulario_alterar_senha'>
<input type='button' value='$idioma_sistema[12]' $eventos[0]>
</div>

</div>
";

// retorno
return $html;

};

?>