<?php

// constroe campo excluir imagem de perfil
function constroe_campo_excluir_imagem_perfil(){

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(62, null, false);

// funcoes
$funcao[0] = "excluir_imagem_perfil();";

// eventos
$eventos[0] = "onclick='$funcao[0]'";

// html
$html = "
<div class='classe_campo_excluir_imagem_perfil' $eventos[0]>
$imagem_sistema[0]
</div>
";

// retorno
return $html;

};

?>