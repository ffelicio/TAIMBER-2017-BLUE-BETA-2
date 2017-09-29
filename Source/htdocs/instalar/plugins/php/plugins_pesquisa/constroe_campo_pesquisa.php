<?php

// constroe o campo de pesquisa
function constroe_campo_pesquisa(){

// globals
global $idioma_sistema;

// valida usuario logado
if(retorne_usuario_logado() == false and PERMITIR_PESQUISAS_DESLOGADO == false){

    // retorno nulo
    return null;
	
};

// id de visualizador de pesquisa
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();
$idcampo[4] = retorne_idcampo_md5();

// funcao
$funcao[0] = "carregar_visualizador_pesquisa_geral(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[3]\", \"$idcampo[4]\", 0);";

// opcoes de pesquisa
$opcoes_pesquisa = constroe_opcoes_pesquisa_geral($idcampo[0], $funcao[0], $idcampo[2], $idcampo[3], $idcampo[4]);

// campos
$campo[0] = "
<script>$funcao[0]</script>
";

// progresso
$progresso[0] = campo_progresso_gif($idcampo[1]);

// html
$html = "
<div class='classe_div_campo_pesquisa_geral'>

$opcoes_pesquisa

<div class='classe_div_campo_visualizar_resultados_pesquisa' id='$idcampo[0]'>
$campo[0]
</div>

$progresso[0]

<div class='classe_paginador_padrao classe_cor_29 span_link' onclick='$funcao[0]'>
$idioma_sistema[61]
</div>

</div>
";

// retorno
return $html;

};

?>