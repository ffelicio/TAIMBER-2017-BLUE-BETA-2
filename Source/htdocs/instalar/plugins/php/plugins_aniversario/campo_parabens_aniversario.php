<?php

// campo parabens de aniversario
function campo_parabens_aniversario(){

// globals
global $idioma_sistema;

// id de usuario logado
$uid = retorne_idusuario_logado();

// dados de perfil
$dados = retorne_dados_perfil_usuario($uid);

// data
$data = $dados[NASCEU];

// valida aniversario de usuario
if(retorne_aniversario($data) == false){

	// retorno nulo
	return null;
	
};

// idade de usuario
$idade = retorne_idade_usuario($data);

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(44, null, false);

// html
$html = "

<div class='classe_parabens_aniversario_texto'>
$idioma_sistema[334]$nome_usuario$idioma_sistema[335]$idade$idioma_sistema[336]
</div>

<div class='classe_parabens_aniversario_imagem'>
$imagem_sistema[0]
</div>

";

// adiciona mensagem de sucesso
$html = mensagem_sucesso($html);

// html
$html = "
<div class='classe_mensagem_parabens_aniversario'>$html</div>
";

// retorno
return $html;

};

?>