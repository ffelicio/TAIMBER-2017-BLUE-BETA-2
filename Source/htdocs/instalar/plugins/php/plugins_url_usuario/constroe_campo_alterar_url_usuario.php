<?php

// constroe o campo alterar a url de usuario
function constroe_campo_alterar_url_usuario($modo){

// modo true e pagina
// modo false e usuario

// globals
global $idioma_sistema;

// modo pagina
$modo_pagina = retorne_modo_pagina();

// uid
$uid = retorne_idusuario_logado();

// url amigavel
$url_amigavel = retorne_somente_nome_amigavel_idusuario($uid, $modo, retorne_idpagina_request());

// id de campos
$idcampo[0] = codifica_md5("id_entrada_campo_url_amigavel_".retorne_contador_iteracao());
$idcampo[1] = codifica_md5("id_resposta_campo_url_amigavel_".retorne_contador_iteracao());

// converte modo para repassar para a funcao javascript
if($modo == true){
	
	// modo pagina
	$modo = 1;
	
}else{
	
	// modo usuario
	$modo = 0;
	
};

// funcoes
$funcao[0] = "salvar_url_amigavel_usuario(\"$idcampo[0]\", \"$idcampo[1]\", \"$modo\");";

// eventos
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";

// tamanho de campo
$tamanho_campo[0] = TAMANHO_URL_AMIGAVEL;

// valida modo pagina
if($modo_pagina == true){
	
	// placeholder
	$placeholder[0] = $idioma_sistema[612];
	
}else{
	
	// placeholder
	$placeholder[0] = $idioma_sistema[390];	
	
};

// campos
$campo[0] = "
<div class='classe_campo_entrada_url_amigavel'>

<div class='classe_campo_entrada_url_amigavel_separa'>
<input type='text' id='$idcampo[0]' value='$url_amigavel' placeholder='$placeholder[0]' maxlength='$tamanho_campo[0]' $evento[1]>
</div>

<div class='classe_campo_entrada_url_amigavel_separa' id='$idcampo[1]'></div>
</div>
";

// campos
$campo[1] = "
<div class='classe_campo_verificar_url_amigavel'>
<input type='button' value='$idioma_sistema[391]' $evento[0]>
</div>
";

// html
$html = "
<div class='classe_campo_alterar_url_usuario'>
$campo[0]
$campo[1]
</div>
";

// retorno
return $html;

};

?>