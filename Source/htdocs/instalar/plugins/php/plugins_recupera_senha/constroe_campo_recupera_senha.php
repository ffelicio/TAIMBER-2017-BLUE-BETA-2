<?php

// constroe o campo recupera senha
function constroe_campo_recupera_senha($modo){

// modo true exibe o formulario completo
// modo false exibe apenas o link para o formulario

// globals
global $idioma_sistema;
global $pagina_inicial;
global $variavel_campo;

// valida usuario logado
if(retorne_usuario_logado() == true){
	
	// retorno nulo
	return null;
	
};

// modo mobile
$modo_mobile = retorne_modo_mobile();

// urls
$url[0] = $pagina_inicial."?$variavel_campo[2]=113";

// valida o modo mobile
if($modo_mobile == true){
	
	// classe
	$classe[0] = "span_link";

}else{
	
	// classe
	$classe[0] = "span_link_2";	
	
};

// valida o modo
if($modo == false){
	
	// html
	$html = "
	<div class='classe_campo_recupera_senha_link'>
	<a href='$url[0]' title='$titulo_link' class='$classe[0]'>$idioma_sistema[444]</a>
	</div>
	";	
	
	// retorno
	return $html;
	
};

// id de campos
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();

// funcoes
$funcao[0] = "envia_redefinir_senha(\"$idcampo[0]\", \"$idcampo[1]\");";

// eventos
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";

// campos
$campo[0] = "
<div class='classe_campo_recupera_senha_campos'>

<div class='classe_campo_recupera_senha_campos_descreve'>
$idioma_sistema[440]
</div>

<div class='classe_campo_recupera_senha_campos_mensagem' id='$idcampo[1]'></div>

<div class='classe_campo_recupera_senha_campos_separa_1'>
<input type='email' placeholder='$idioma_sistema[438]' id='$idcampo[0]' $evento[1]>
</div>

<div class='classe_campo_recupera_senha_campos_separa_2'>
<input type='button' value='$idioma_sistema[439]' $evento[0]>
</div>

</div>
";

// html
$html = "
<div class='classe_campo_recupera_senha'>
$campo[0]
</div>
";

// retorno
return constroe_caixa_descritiva($idioma_sistema[444], $html, null);

};

?>