<?php

// constroe o campo marcador de usuario
function constroe_campo_marcador_usuario($uidamigo, $chave, $modo, $modo_pesquisa){

// globals
global $idioma_sistema;

// id de campo
$idcampo[0] = codifica_md5("idcampo_marcador_usuario_$uidamigo");

// valida o estado do marcador
if($modo == true){
	
	// desmarca
    $modo_marcar = 2;
	
	// classe
	$classe[0] = "elemento_visivel_table";
	$classe[1] = "span_link_3";
	
    // texto de botao
	$texto_botao[0] = $idioma_sistema[208];

}else{
	
	// marca
    $modo_marcar = 1;
	
	// classe
	$classe[0] = "elemento_oculto";
	$classe[1] = "span_link";
	
	// texto de botao
	$texto_botao[0] = $idioma_sistema[205];

};

// eventos
$evento[0] = "onclick='marcar_usuario(\"$uidamigo\", \"$chave\", \"$modo_marcar\", \"$idcampo[0]\");'";

// html
$html = "
<div class='classe_campo_marcar_usuario_adicionar_botao'>

<span class='$classe[1]' $evento[0]>
$texto_botao[0]
</span>

</div>
";

// valida o modo
if($modo_pesquisa == true){
	
    // html
    $html = "
    <div class='classe_campo_marcar_usuario_adicionar' id='$idcampo[0]'>
    $html
    </div>
    ";

};

// retorno
return $html;

};

?>