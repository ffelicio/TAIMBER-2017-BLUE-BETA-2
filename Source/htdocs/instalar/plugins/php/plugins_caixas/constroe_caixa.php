<?php

// constroe caixa
function constroe_caixa($modo, $conteudo){

// modo true exibe padding e bordas
// modo false exibe sem padding e bordas

// valida conteudo
if($conteudo == null){

	// retorno nulo
	return null;
	
};

// valida o modo
if($modo == true){
	
	// classe
	$classe[0] = "classe_div_caixa_sistema_2 borda_div_5";
	
}else{
	
	// classe
	$classe[0] = "classe_div_caixa_sistema";

};

// html
$html = "
	
<div class='$classe[0]'>

<div class='classe_div_caixa_sistema_conteudo'>
$conteudo
</div>

</div>
	
";
	
// retorno
return $html;

};

?>