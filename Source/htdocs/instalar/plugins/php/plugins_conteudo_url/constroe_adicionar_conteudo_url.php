<?php

// constroe o campo para adicionar conteudo via url
function constroe_adicionar_conteudo_url($idcampo_entrada, $idcampo_visualiza, $idcampo_resultados){

// globals
global $idioma_sistema;

// imagens de sistema
$imagem[0] = retorne_imagem_sistema(43, null, false);

// id de campos
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();

// funcoes
$funcao[0] = "adicionar_conteudo_url(\"$idcampo[1]\", \"$idcampo_resultados\", \"$idcampo_visualiza\", \"$idcampo[2]\", \"$idcampo[3]\");";
$funcao[1] = "exibe_dialogo(\"$idcampo[0]\")";

// eventos
$evento[0] = "onclick='$funcao[1];'";
$evento[1] = "onclick='$funcao[0]'";
$evento[2] = "onclick='$funcao[1], publicar_conteudo_url(\"$idcampo[1]\", \"$idcampo[3]\", \"$idcampo_resultados\");'";
$evento[3] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";

// campos
$campo[0] = "
<div class='classe_add_conteudo_url' $evento[0]>$imagem[0]</div>
";

// progresso
$progresso[0] = campo_progresso_gif($idcampo[2]);

// campos
$campo[1] = "
<div class='classe_add_conteudo_campos'>

<div class='classe_add_conteudo_campos_separa classe_cor_8'>

<div class='classe_add_conteudo_campos_separa_div_1'>
<input type='text' placeholder='$idioma_sistema[405]' id='$idcampo[1]' $evento[3]>
</div>

<div class='classe_add_conteudo_campos_separa_div_2'>
<input type='button' value='$idioma_sistema[406]' $evento[1]>
</div>

</div>

$progresso[0]

<div class='classe_add_conteudo_campos_separa' id='$idcampo_resultados'></div>

<div class='classe_add_conteudo_campos_separa_botao' id='$idcampo[3]'>
<input type='button' value='$idioma_sistema[410]' $evento[2]>
</div>

</div>
";

// adiciona dialogo
$campo[1] = constroe_dialogo($idioma_sistema[404], $campo[1], $idcampo[0]);

// html
$html = "
$campo[0]
$campo[1]
";

// retorno
return $html;

};

?>