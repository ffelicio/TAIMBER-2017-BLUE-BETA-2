<?php

// constroe o visualizador de emoticons
function constroe_visualizador_emoticons($modo, $modo_topo, $modo_dialogo, $id_campo_entrada){

// globals
global $idioma_sistema;

// campo visualiza emoticon
$campo_visualiza = campo_visualiza_emoticon($id_campo_entrada);

// campos
$campo[0] = $campo_visualiza["html"];

// funcoes
$funcao[0] = $campo_visualiza["funcao"];
$funcao[1] = "atualiza_posicao_cursor_emoticon(\"$id_campo_entrada\")";

// imagens de sistema
$imagem_sistema[0] = retorne_imagem_sistema(17, null, false);

// adiciona o menu de suspense
$html = constroe_menu_suspense($modo_topo, $funcao[0].", $funcao[1]", $modo, 17, null, $campo[0]);

// retorno
return $html;

};

?>
