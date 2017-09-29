<?php

// constroe o conteudo padrao
function constroe_conteudo_padrao($modo, $conteudo, $idcampo){

// modo true deixa padding
// modo false não deixa padding

// valida o modo
if($modo == true){
	
	// classes
	$classe[0] = "classe_conteudo_centro_padrao";
	
}else{
	
	// classes
	$classe[0] = "classe_conteudo_centro_padrao_2";	

};

// html
$html = "
<div class='$classe[0]' id='$idcampo'>
$conteudo
</div>
";

// retorno
return $html;

};

?>