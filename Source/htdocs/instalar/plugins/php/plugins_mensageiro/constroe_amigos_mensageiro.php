<?php

// constroe os amigos do mensageiro
function constroe_amigos_mensageiro($array_idcampos){

// globals
global $idioma_sistema;

// modo mobile
$modo_mobile = retorne_modo_mobile();

// id de campos
$idcampo[0] = $array_idcampos[0];
$idcampo[1] = $array_idcampos[1];
$idcampo[2] = $array_idcampos[2];

// funcoes
$funcao[0] = "carregar_amigos_mensageiro(\"$idcampo[0]\", \"$idcampo[2]\")";

// eventos
$eventos[0] = "onkeyup='$funcao[0];'";
$eventos[1] = "onscroll='$funcao[0];'";

// timers
$timer[0] = plugin_timer_sistema(9, $funcao[0]);

// scripts
$script[0] = "
<script>
$funcao[0]
</script>
";

// campos
$campo[0] = "
<div class='classe_pesquisa_amigos_mensasgeiro classe_cor_2'>
<input type='text' placeholder='$idioma_sistema[68]' id='$idcampo[2]' $eventos[0]>
</div>
";

// valida se está conversando com alguém, e se está no modo mobile
if($modo_mobile == true and retorne_uidamigo_aberto_mensageiro() != null){
	
	// limpa o timer
	$timer[0] = null;
	
	// limpa os scripts
	$script[0] = null;
	
	// limpa campos
	$campo[0] = null;
	
};

// campos
$campo[1] = "
<div class='classe_amigos_mensageiro' id='$idcampo[0]' $eventos[1]></div>
";

// html
$html = "
$campo[0]
$campo[1]

$script[0]
$timer[0]
";

// retorno
return $html;

};

?>