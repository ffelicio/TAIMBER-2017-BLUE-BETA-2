<?php

// retorna mensagem de privacidade
function mensagem_privacidade_usuario(){

// globals
global $idioma_sistema;

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(46, null, false);

// nome de usuario logado
$nome_usuario_logado = retorne_nome_usuario_logado();
$nome_usuario = retorne_nome_usuario(true, retorne_idusuario_request());

// html
$html = "
<div class='mensagem_privacidade_usuario'>

<div class='mensagem_privacidade_usuario_texto'>
$nome_usuario_logado$idioma_sistema[164]$nome_usuario$idioma_sistema[163]
</div>

<div class='mensagem_privacidade_usuario_imagem'>
$imagem_sistema[0]
</div>

</div>
";

// retorno
return constroe_caixa(false, $html);

};

?>