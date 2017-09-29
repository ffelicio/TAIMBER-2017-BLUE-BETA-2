<?php

// constroe as opcoes de pesquisa geral
function constroe_opcoes_pesquisa_geral($idcampo, $funcao_1, $idcampo_2, $idcampo_3, $idcampo_4){

// globals
global $idioma_sistema;

// nome de pesquisa
$nome_pesquisa = retorne_campo_formulario_request(7);

// modo de pesquisa
$modo_pesquisa = retorne_campo_formulario_request(8);

// eventos
$evento[0] = "executador_acao(null, 17, null), $funcao_1";
$evento[1] = "onkeyup='$funcao_1'";

// campo opcoes de pesquisa
$campo_opcoes = gerador_select_option_especial(CAMPO_TABELA_PERFIL_CAMPOS_2, trata_campo_tabela(CAMPO_TABELA_PERFIL_CAMPOS_3, false), $modo_pesquisa, null, "$idcampo_3", $evento[0]);

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(66, null, false);

// html
$html = "
<div class='classe_div_campo_pesquisa_geral_entrada_pesquisa'>

<div class='classe_div_campo_pesquisa_geral_entrada_pesquisa_topo'>
$idioma_sistema[66]
</div>

<div class='classe_div_campo_pesquisa_geral_entrada_imagem'>
$imagem_sistema[0]
</div>

<div class='classe_div_opcoes_visualizador_resultados_pesquisa_1'>
<input type='text' placeholder='$idioma_sistema[68]' value='$nome_pesquisa' id='$idcampo_2' $evento[1]'>
</div>

<div class='classe_div_opcoes_visualizador_resultados_pesquisa_2'>
$campo_opcoes
</div>

<div class='classe_div_opcoes_visualizador_resultados_pesquisa_4'>
<input type='text' placeholder='$idioma_sistema[486]' id='$idcampo_4' $evento[1]'>
</div>

</div>
";

// retorno
return $html;

};

?>