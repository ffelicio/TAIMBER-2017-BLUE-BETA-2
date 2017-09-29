<?php

// constroe o campo marcar
function constroe_campo_marcar($idcampo_entrada, $chave, $id, $tabela){

// globals
global $idioma_sistema;

// id de campos
$idcampo[0] = $idcampo_entrada;
$idcampo[1] = codifica_md5("idcampo_exibe_resultados_campo_marcar".data_atual().$idcampo_entrada);
$idcampo[2] = codifica_md5("idcampo_entrada_pesquisa_campo_marcar".data_atual().$idcampo_entrada);
$idcampo[3] = codifica_md5("id_campo_balao_notifica_marcador_".data_atual().$idcampo_entrada);

// id de dialogo
$id_dialogo[0] = codifica_md5("id_menu_suspense_marcador_$idcampo[0]".data_atual().$idcampo_entrada);

// funcoes
$funcao[0] = "pesquisar_marcador(\"$idcampo[2]\", \"$idcampo[1]\", \"$idcampo[3]\", \"$chave\", \"$id\", \"$tabela\");";

// eventos
$eventos[0] = "onclick='exibe_dialogo(\"$id_dialogo[0]\");'";
$eventos[1] = "onkeyup='$funcao[0]'";
$eventos[2] = "onclick='marcacoes_concluidas(\"$chave\", \"$id_dialogo[0]\", 1);'";
$eventos[3] = "onclick='marcacoes_concluidas(\"$chave\", \"$id_dialogo[0]\", 2);'";
$eventos[4] = "onclick='exibir_amigos_marcados(\"$chave\", \"$idcampo[1]\");'";
$eventos[5] = "onscroll='$funcao[0]'";

// imagem
$imagem[0] = retorne_imagem_sistema(82, null, false);

// html
$html = "
<div class='classe_campo_marcar_entrada'>
<input type='text' placeholder='$idioma_sistema[204]' id='$idcampo[2]' $eventos[1]>
</div>

<div class='classe_campo_marcar_resultados' id='$idcampo[1]' $eventos[5]></div>

<div class='classe_campo_marcar_entrada_salvar'>
<span class='span_link' $eventos[2]>$idioma_sistema[207]</span>
<span class='span_link' $eventos[3]>$idioma_sistema[209]</span>
<span class='span_link' $eventos[4]>$idioma_sistema[211]</span>
</div>

";

// adiciona dialogo
$html = constroe_dialogo($idioma_sistema[203], $html, $id_dialogo[0]);

// balao de notifica
$balao_notifica[0] = constroe_balao_notifica($idcampo[3], null);

// html
$html = "
<div class='classe_campo_marcar_abre_dialogo' $eventos[0]>
	$imagem[0]
</div>

<div class='classe_campo_marcar_balao_notifica'>
	$balao_notifica[0]
</div>

$html
";

// retorno
return $html;

};

?>