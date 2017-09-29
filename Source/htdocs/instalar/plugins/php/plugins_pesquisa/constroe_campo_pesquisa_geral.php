<?php

// constroe o campo de pesquisa geral
function constroe_campo_pesquisa_geral(){

// campos
$campo[0] = constroe_campo_pesquisa();

// html
$html = "
<div class='classe_conteudo_centro_padrao'>
$campo[0]
</div>
";

// retorno
return $html;

};

?>