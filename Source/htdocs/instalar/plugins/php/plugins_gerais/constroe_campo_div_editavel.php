<?php

// constroe campo com div editavel
function constroe_campo_div_editavel($modo, $idcampo_1, $conteudo, $classe, $evento, $placeholder){

// modo true exibe a borda
// modo false nao exibe a borda

// valida classe
if($classe == null){
	
	// classe padrao
	$classe_padrao[0] = "classe_padrao_div_editavel";
	
};

// valida o modo borda
if($modo == true){
	
	// classe padrao
	$classe_padrao[1] = " borda_div_5 classe_padrao_div_editavel_imagem";

}else{
	
	// classe padrao
	$classe_padrao[1] = " borda_div_2 classe_padrao_div_editavel_imagem";
	
};

// classe
$classe .= $classe_padrao[0].$classe_padrao[1];

// html
$html = "
<div contenteditable class='$classe' id='$idcampo_1' placeholder='$placeholder' $evento>$conteudo</div>
";

// retorno
return $html;

};

?>