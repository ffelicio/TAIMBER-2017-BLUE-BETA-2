<?php

// constroe campo mensagem ativar conta de usuario
function constroe_campo_mensagem_ativar_usuario(){

// globals
global $idioma_sistema;
global $variavel_campo;

// valida usuario logado
if(retorne_usuario_logado() == false or ATIVADOR_HABILITADO == false){
	
	// retorno nulo
	return null;
	
};

// valida usuario logado ativou a conta
if(retorne_usuario_logado_ativou_conta() == true){
	
	// retorno nulo
	return null;
	
};

// email de usuario logado
$email = retorna_email_usuario_logado();

// mensagem
$mensagem[0] = retorne_nome_usuario_logado().$idioma_sistema[425];

// url de inicio
$url_inicio = PAGINA_INDEX_INICIO;

// links
$link[0] = "<a href='$url_inicio?$variavel_campo[2]=100' title='$idioma_sistema[426]'>$idioma_sistema[427]$email</a>";

// campos
$campo[0] = "
<div class='classe_mensagem_ativar_conta_usuario'>
$mensagem[0]
</div>

<div class='classe_mensagem_ativar_conta_usuario_link'>
$link[0]
</div>
";

// campos
$campo[0] = mensagem_informa($campo[0]);

// html
$html = "
<div class='classe_campo_ativar_usuario'>
$campo[0]
</div>
";

// retorno
return $html;

};

?>