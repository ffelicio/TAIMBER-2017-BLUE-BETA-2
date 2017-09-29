<?php

// constroe as opcoes de comentario
function constroe_opcoes_comentario($dados){

// globals
global $idioma_sistema;
global $variavel_campo;

// separando dados
$id = $dados['id'];

// url de index de inicio
$url_index_inicio = PAGINA_INDEX_INICIO;

// urls
$url[0] = $url_index_inicio."?".$variavel_campo[9]."=$id";

// opcoes
$opcao[0] = "
<div class='classe_div_opcao_menu_suspense'>
<a href='$url[0]' title='$idioma_sistema[576]'>$idioma_sistema[576]</a>
</div>
";

// adiciona menu de suspense
$campo[0] = constroe_menu_suspense(false, null, false, null, null, $opcao[0]);

// campos
$campo[0] = "
<div class='classe_opcoes_comentario_separa'>
$campo[0]
</div>
";

// html
$html = "
<div class='classe_opcoes_comentario'>
$campo[0]
</div>
";

// retorno
return $html;

};

?>