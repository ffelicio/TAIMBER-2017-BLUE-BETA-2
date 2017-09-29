<?php

// campo visualiza emoticon
function campo_visualiza_emoticon($id_campo_entrada){

// globals
global $idioma_sistema;

// id de campos
$idcampo[0] = retorne_idcampo_md5();

// funcoes
$funcao[0] = "carregar_emoticons(\"$idcampo[0]\", \"$id_campo_entrada\")";

// eventos
$evento[0] = "onscroll='$funcao[0]'";

// campo visualizar
$html = "
<div class='classe_visualizador_emoticons'>
<div class='classe_visualizador_emoticons_lista' id='$idcampo[0]' $evento[0]></div>
</div>
";

// array de retorno
$array_retorno["html"] = $html;
$array_retorno["funcao"] = $funcao[0];

// retorno
return $array_retorno;

};

?>