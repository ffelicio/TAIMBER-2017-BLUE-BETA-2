<?php

// campo limpar o perfil do usuario
function campo_limpar_perfil(){

// globals
global $idioma_sistema;

// id de campos
$idcampo[0] = codifica_md5("campo_select_limpar_perfil_".data_atual());

// eventos
$eventos[0] = "onclick='limpar_perfil();'";
$eventos[1] = "alterar_modo_limpar_perfil(\"$idcampo[0]\")";

// opcoes disponiveis
$array_options = "
$idioma_sistema[144],
$idioma_sistema[145],
$idioma_sistema[146],
$idioma_sistema[147],
$idioma_sistema[148],
$idioma_sistema[149],
$idioma_sistema[226],
$idioma_sistema[289],
$idioma_sistema[564]
";

// valores de opcoes
$array_valores = "1,2,3,4,5,6,7,8,9";

// campo com opcoes de limpeza
$campo_opcoes = gerador_select_option_especial($array_options, $array_valores, null, null, $idcampo[0], $eventos[1]);

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(12, null, false);

// descricao
$descricao = mensagem_sucesso($imagem_sistema[0]." ".$nome_usuario.$idioma_sistema[150]);

// html
$html = "
<div class='classe_campo_limpar_perfil'>

<div class='classe_campo_limpar_perfil_descricao'>
$descricao
</div>

<div class='classe_campo_limpar_perfil_opcoes'>
$campo_opcoes
</div>

<div class='classe_campo_limpar_perfil_campo_acao'>
<input type='button' value='$idioma_sistema[143]' $eventos[0]>
</div>

</div>
";

// retorno
return $html;

};

?>