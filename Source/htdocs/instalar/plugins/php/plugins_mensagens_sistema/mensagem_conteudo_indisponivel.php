<?php

// mensagem de conteudo indisponível
function mensagem_conteudo_indisponivel(){

// globals
global $idioma_sistema;

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(115, false, false);	

// valida usuario logado
if(retorne_usuario_logado() == true){
	
	// nome do usuario
	$nome_usuario = retorne_nome_usuario_logado();

}else{
	
	// nome de usuario
	$nome_usuario = $idioma_sistema[415];
	
};

// mensagem a exibir
$mensagem_exibir = $nome_usuario.$idioma_sistema[97];

// url de pagina inicial
$url_pagina_inicial = PAGINA_INICIAL;

// html
$html = "
<div class='classe_mensagem_conteudo_indisponivel'>

<div class='classe_mensagem_conteudo_indisponivel_img'>
$imagem_sistema[0]
</div>

<div class='classe_mensagem_conteudo_indisponivel_div'>
$mensagem_exibir
</div>

<div class='classe_mensagem_conteudo_indisponivel_div'>
<a href='$url_pagina_inicial' title='$idioma_sistema[99]'>$idioma_sistema[99]</a>
</div>

</div>
";

// retorno
return $html;

};

?>