<?php

// constroe o css de forma manual
function constroe_css_manual($classe, $id, $propriedades){

// ou passa a classe ou passa o id

// valida a classe
if($classe != null){
	
	// seletor
	$seletor = ".$classe";
	
};

// valida id
if($id != null){
	
	// seletor
	$seletor = "#$id";
	
};

// html
$html = "
<style>

$seletor{
	
	$propriedades

}

</style>
";

// retorno
return $html;

};

?>