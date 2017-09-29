<?php

// encurta texto
function encurta_texto($texto, $tamanho){

// globals
global $idioma_sistema;

// valida tamaho de texto
if(strlen($texto) <= $tamanho or retorne_texto_contem_html($texto) == true){
	
	// retorno
	return $texto;

};

// id de campos
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();

// textos
$sub_texto = substr($texto, 0, $tamanho)."...";

// eventos
$evento[0] = "onclick='encurtar_texto(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", true);'";
$evento[1] = "onclick='encurtar_texto(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", false);'";

// html
$html = "
<div class='classe_encurta_texto_original' id='$idcampo[1]'>
$texto
</div>

<div class='classe_encurta_texto_exibe_menos' id='$idcampo[2]'>
<span class='span_link' $evento[1]>$idioma_sistema[522]</span>
</div>


<div class='classe_encurta_texto' id='$idcampo[0]'>

<div class='classe_encurta_texto_parte'>
$sub_texto
</div>

<div class='classe_encurta_texto_exibe_mais'>
<span class='span_link' $evento[0]>$idioma_sistema[521]</span>
</div>

</div>
";

// retorno
return $html;

};

?>