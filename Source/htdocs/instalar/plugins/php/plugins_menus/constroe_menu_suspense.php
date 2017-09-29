<?php

// constroe o menu de suspense
function constroe_menu_suspense($modo_topo, $funcoes_adicionais, $modo, $numero_imagem, $menu_id, $conteudo_menu){

// modo true abre do lado direito
// modo false abre do lado esquerdo
// em funcoes adicionais não adicionar ; no final das funcoes

// globals
global $idioma_sistema;

// valida id de menu
if($menu_id == null){
	
	// id de menu padrao
	$menu_id = retorne_idcampo_md5();
	
};

// modo mobile
$modo_mobile = retorne_modo_mobile();

// valida o modo mobile
if($modo_mobile == true){
	
	// imagem de sistema
	$imagem_sistema[0] = retorne_imagem_sistema(1, null, false);
	
}else{
	
	// imagem de sistema
	$imagem_sistema[0] = retorne_imagem_sistema(76, null, false);
	
};

// valida numero de imagem
if($numero_imagem != null){
	
	// imagem de sistema
	$imagem_sistema[0] = retorne_imagem_sistema($numero_imagem, null, false);
	
};

// imagem de sistema
$imagem_sistema[1] = retorne_imagem_sistema(36, null, false);

// valida funcao adicional
if($funcoes_adicionais == null){
	
	// funcoes
	$funcao[0] = "abrir_menu_suspense(\"$modo_topo\", \"$menu_id\", this, \"$modo\");";

}else{
	
	// funcoes
	$funcao[0] = "abrir_menu_suspense(\"$modo_topo\", \"$menu_id\", this, \"$modo\"), $funcoes_adicionais;";

};

// funcoes
$funcao[1] = "exibe_elemento_oculto(\"$menu_id\", null);";

// eventos
$evento[0] = "onclick='$funcao[0];'";
$evento[1] = "onmouseleave='$funcao[1];'";

// valida o modo mobile
if($modo_mobile == false){
	
	// eventos
	$evento[2] = "onmousemove='$funcao[0]'";

};

// valida modo mobile
if(retorne_modo_mobile() == true){
	
	// campos
	$campo[0] = "

	<div class='classe_div_menu_suspense_fechar'>

	<span onclick='fechar_menu_suspense(\"$menu_id\");'>
	$imagem_sistema[1]
	</span>

	</div>

	";

};

// html
$html = "
<div class='classe_menu_suspense_principal'>

<div class='classe_div_abre_menu_suspense' $evento[0] $evento[2]>
$imagem_sistema[0]
</div>

<div class='classe_div_menu_suspense cor_borda_div_4 elemento_efeito cor_borda_div_3' id='$menu_id' $evento[1]>

$campo[0]

<div class='classe_div_menu_suspense_conteudo'>
$conteudo_menu
</div>

</div>

</div>

";

// retorno
return $html;

};

?>