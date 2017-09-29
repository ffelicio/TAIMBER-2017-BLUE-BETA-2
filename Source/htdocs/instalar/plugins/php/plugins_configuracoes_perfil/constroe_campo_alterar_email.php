<?php

// constroe o campo de alterar o e-mail
function constroe_campo_alterar_email(){

// globals
global $idioma_sistema;

// valida usuario pode alterar o email
if(retorne_pode_alterar_email() == false){
	
	// retorno
	return mensagem_erro($idioma_sistema[441]);
	
};

// id de campos
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();

// funcoes
$funcao[0] = "atualizar_email(\"$idcampo[0]\", \"$idcampo[1]\");";

// eventos
$evento[0] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";
$evento[1] = "onclick='$funcao[0]'";

// campo
$campo[0] = mensagem_informa(retorne_nome_usuario_logado().$idioma_sistema[459]);

// html
$html = "
<div class='classe_campo_alterar_email'>

<div class='classe_campo_alterar_email_mensagem' id='$idcampo[1]'>
$campo[0]
</div>

<div class='classe_campo_alterar_email_campo_1'>
<input type='text' placeholder='$idioma_sistema[453]' id='$idcampo[0]' $evento[0]>
</div>

<div class='classe_campo_alterar_email_campo_2'>
<input type='button' value='$idioma_sistema[454]' $evento[1]>
</div>

</div>
";

// retorno
return $html;

};

?>