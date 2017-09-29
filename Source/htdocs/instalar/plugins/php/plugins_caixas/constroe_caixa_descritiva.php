<?php

// constroe caixa descritiva
function constroe_caixa_descritiva($titulo, $conteudo, $imagem){

// valida imagem
if($imagem != null){
	
	// campo
	$campo[0] = "
	<div class='classe_caixa_descritiva_imagem'>$imagem</div>
	<div class='classe_caixa_descritiva_conteudo_imagem'>
	<div class='balao_esquerdo'>$conteudo</div>
	</div>
	";
	
}else{
	
	// campo
	$campo[0] = "
	<div class='classe_caixa_descritiva_conteudo'>$conteudo</div>
	";
	
};

//html
$html = "
<div class='classe_caixa_descritiva'>

<div class='classe_caixa_descritiva_titulo classe_cor_5 classe_cor_8'>
$titulo
</div>

$campo[0]
</div>
";

// retorno
return $html;

};

?>